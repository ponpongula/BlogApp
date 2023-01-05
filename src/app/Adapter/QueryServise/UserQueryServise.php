<?php
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../Domain/Entity/User.php';
require_once __DIR__ . '/../../Domain/Entity/UserAge.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Email.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/HashedPassword.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Age.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/RegistrationDate.php';


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

    public function __construct()
    {
        $this->userDao = new UserDao();
        $this->userAgeDao = new UserAgeDao();
    }

    public function findByEmail(Email $email): ?array//Userから変更
    {
        return $this->userDao->findByEmail($email);
    }

    public function singInFindByEmail(Email $email): ?User//Userから変更
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