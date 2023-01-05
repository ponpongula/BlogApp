<?php
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserAgeDao.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/NewUser.php';

final class UserRepository
{
    /**
     * @var UserDao
     */
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
        $this->userAgeDao = new UserAgeDao();
    }

    public function insert(NewUser $user): void
    {
        $this->userDao->create($user);
    }

    public function ageInsert(UserAge $user): void
    {
        $this->userAgeDao->create($user);
    }
}
?>