<?php
require_once __DIR__ . '/../../Adapter/QueryServise/UserQueryServise.php';
require_once __DIR__ . '/../../Adapter/Repository/UserRepository.php';
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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserQueryServise
     */
    private $userQueryServise;

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
        UserQueryServise $userQueryServise,
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userQueryServise = $userQueryServise;
        $this->input = $input;
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
    
        if ($user !== null) {
            return new SignUpOutput(false);
        }

        $this->signup();
        return new SignUpOutput(true);
    }

    /**
     * ユーザーを入力されたメールアドレスで検索する
     *
     * @return array
     */
    private function findUser(): ?array//Userから変更
    {
        return $this->userQueryServise->findByEmail($this->input->email());
    }

    /**
     * ユーザーの登録
     * 
     * @return void
     */
    private function signup(): void
    {
        $this->userRepository->insert(
            new NewUser(
                $this->input->name(),
                $this->input->email(),
                $this->input->password()
            )
        );

        $user = $this->findUser();
        $this->userRepository->ageInsert(
            new UserAge(new UserId($user['id']), $this->input->age())
        );
    }
}
?>