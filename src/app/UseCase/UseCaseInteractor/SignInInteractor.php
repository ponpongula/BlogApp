<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\UserQueryServise;
use App\UseCase\UseCaseInput\SignInInput;
use App\UseCase\UseCaseOutput\SignInOutput;
use App\Domain\Entity\User;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\Email;
use App\Domain\ValueObject\User\HashedPassword;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\RegistrationDate;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;


/**
 * ログインユースケース
 */
final class SignInInteractor
{
    /**
     * @var SignInInput
     */
    private $input;

    /**
     * @var UserQueryServise
     */
    private $userQueryServise;

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
        $this->input = $input;
        $this->userQueryServise = $userQueryServise;
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
    private function findUser(): ?User
    {
        return $this->userQueryServise->signInfindByEmail($this->input->email());
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
        session_start();
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