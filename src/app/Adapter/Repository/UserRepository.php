<?php
namespace App\Adapter\Repository;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;
use App\Domain\ValueObject\User\NewUser;

final class UserRepository
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

    public function insert(NewUser $user): void
    {
        $this->userDao->create($user);
    }

    public function insertAge(UserAge $user): void
    {
        $this->userAgeDao->create($user);
    }
}
?>