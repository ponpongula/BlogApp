<?php
require_once __DIR__ . '/../UseCaseInput/SignUpInput.php';
require_once __DIR__ . '/../UseCaseOutput/SignUpOutput.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/NewUser.php';

final class SignUpInteractor
{
    /**
     * メールアドレスがすでに存在している場合のエラーメッセージ
     */
    const ALLREADY_EXISTS_MESSAGE = 'すでに登録済みのメールアドレスです';
    /**
     * ログイン成功時のメッセージ
     */
    const COMPLETED_MESSAGE = '登録が完了しました';
    /**
    * @var UserDao
    */
    private $userDao;

    /**
    * @var SignUpInput
    */
    private $useCaseInput;
     
    /**
    * コンストラクタ
    *
    * @param SignUpInput $input
    */
    public function __construct(SignUpInput $useCaseInput)
    {
        $this->useCaseInput = $useCaseInput;
    }

    /**
    * ユーザー登録処理
    * すでに存在するメールアドレスの場合はエラーとする
    *
    * @return SignUpOutput
    */
    public function handler(): SignUpOutput
    {
        $userDao = new UserDao();
        $user = $userDao->findByEmail($this->useCaseInput->email());
        
        if (!is_null($user)) {
            return new SignUpOutput(false, self::ALLREADY_EXISTS_MESSAGE);
        }
        
        $userDao->create(
            $this->useCaseInput->name(),
            $this->useCaseInput->email(),
            $this->useCaseInput->password()
        );
        return new SignUpOutput(true, self::COMPLETED_MESSAGE);
    }
    
    /**
     * ユーザーを入力されたメールアドレスで検索する
     *
     * @return array
     */
    private function findUser(): ?array
    {
        return $this->userDao->findByEmail($this->useCaseInput->email()->value());
    }

    /**
     * ユーザーが存在するかどうか
     *
     * @param array|null $user
     * @return boolean
     */
    private function existsUser(?array $user): bool
    {
        return !is_null($user);
    }

    /**
     * ユーザーを登録する
     *
     * @return void
     */
    private function signup(): void
    {
        $this->userDao->create(
            new NewUser(
                $this->useCaseInput->name(),
                $this->useCaseInput->email(),
                $this->useCaseInput->password()
            )
        );
    }
}
?>