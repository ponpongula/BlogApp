<?php
namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;
use App\Domain\Entity\User;
use App\Domain\Entity\UserAge;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\Email;
use App\Domain\ValueObject\User\HashedPassword;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\RegistrationDate;

final class UserQueryServise
{
    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var UserAgeDao
     */
    private $userAgeDao;

    public function __construct(UserDao $userDao, UserAgeDao $userAgeDao)
    {
        $this->userDao = $userDao;
        $this->userAgeDao = $userAgeDao;
    }

    public function findByEmail(Email $email): ?array
    {
        return $this->userDao->findByEmail($email);
    }

    public function signInFindByEmail(Email $email): ?User
    {
        $user = $this->userDao->findByEmail($email);
        $userAge = $this->userAgeDao->fetchAll($user['id']);
        if ($userAge === null) {
            return null;
        }
        return new User(
            new UserId($user['id']),
            new UserName($user['name']),
            new Email($user['email']),
            new HashedPassword($user['password']),
            new Age($userAge['age']),
            new RegistrationDate($userAge['created_at'])
        );
    }
}
