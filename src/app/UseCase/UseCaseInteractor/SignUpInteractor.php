<?php
require_once __DIR__ . '/../UseCaseInput/SignUpInput.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserAgeDao.php';
require_once __DIR__ . '/../UseCaseOutput/SignUpOutput.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/NewUser.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/Entity/UserAge.php';

final class SignUpInteractor
{
    /**
     * @var SignUpInput
     */
    private $input;

    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var UserAgeDao
     */
    private $userAgeDao;

    /**
     * コンストラクタ
     *
     * @param SignUpInput $input
     * @param UserDao $userDao
     * @param UserAgeDao $userAgeDao
     *
     */
    public function __construct(
        SignUpInput $input,
        UserDao $userDao,
        UserAgeDao $userAgeDao
    ) {
        $this->input = $input;
        $this->userDao = $userDao;
        $this->userAgeDao = $userAgeDao;
    }

    /**
    * ユーザー登録処理
    * すでに存在するメールアドレスの場合はエラー
    *
    * @return SignUpOutput
    */
    public function handler(): SignUpOutput
    {
        $user = $this->findUser();
        //!is_null($user)なんで変更？
        if ($user !== null) {
            return new SignUpOutput(false);
        }

        $this->signup();
        return new SignUpOutput(true);
    }
    
    /**
     * ユーザーの入力されたメールアドレスで検索
     * 
     * @return array
     */
    private function findUser(): ?array
    {
        return $this->userDao->findByEmail($this->input->email());
    }

    /**
     * ユーザーの登録
     * 
     * @return void
     */
    private function signup(): void
    {
        $this->userDao->create(
            new NewUser(
                $this->input->name(),
                $this->input->email(),
                $this->input->password()
            )
        );

        $user = $this->findUser();
        $this->userAgeDao->create(
            new UserAge(new UserId($user['id']), $this->input->age())
        );
    }
}
?>