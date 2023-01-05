<?php
require_once __DIR__ . '/../../Adapter/QueryServise/UserQueryServise.php';
require_once __DIR__ . '/../../Domain/Entity/User.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Email.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/HashedPassword.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Age.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/RegistrationDate.php';
require_once __DIR__ . '/../UseCaseInput/SignInInput.php';
require_once __DIR__ . '/../UseCaseOutput/SignInOutput.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserAgeDao.php';

/**
 * ログインユースケース
 */
final class SignInInteractor
{
    /**
     * @var UserQueryServise
     */
    private $userQueryServise;

    /**
     * @var SignInInput
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
     * @param SignInInput $input
     * @param UserQueryServise $userQueryServise
     * 
     */
    public function __construct(
        SignInInput $input, 
        UserQueryServise $userQueryServise
    ) {
        $this->userQueryServise = $userQueryServise;
        $this->input = $input;
        $this->userDao = $userDao;
        $this->userAgeDao = $userAgeDao;
    }

    /**
     * ログイン処理
     * セッションへのユーザー情報の保存も行う
     * 
     * @return SignInOutput
     */
    public function handler(): SignInOutput
    {
        $user = $this->findUser();

        if ($user === null) {
            return new SignInOutput(false);
        }
        
        if ($this->isInvalidPassword($user->password())) {
            return new SignInOutput(false);
        }
        
        $this->saveSession($user);
        return new SignInOutput(true);
    }

    /**
     * ユーザーを入力されたメールアドレスで検索する
     *
     * @return array | null
     */
    private function findUser(): ?User//Userから変更
    {
        return $this->userQueryServise->singInfindByEmail($this->input->email());
    }

    /**
     * パスワードが正しいかどうか
     * 
     * @param HashedPassword $hashedPassword
     * @return boolean
     */
    private function isInvalidPassword(HashedPassword $hashedPassword): bool
    {
        return !$hashedPassword->verify($this->input->password());
    }

    /**
     * セッションの保存処理
     * 
     * @param User $user
     * @return void
     */
    private function saveSession(User $user): void
    {
        $_SESSION['user']['id'] = $user->id()->value();
        $_SESSION['user']['name'] = $user->name()->value();

        if ($user->isPremiumMember()) {
            $_SESSION['user']['memberStatus'] = 'プレミアム会員';
        }

        if (!$user->isPremiumMember()) {
            $_SESSION['user']['memberStatus'] = 'ノーマル会員';
        }
    }
}

?>