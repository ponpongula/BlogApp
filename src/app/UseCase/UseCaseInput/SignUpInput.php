<?php
require_once __DIR__ . '/../../Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Email.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/InputPassword.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Age.php';

/**
 * ユーザー登録ユースケースの入力値
 */
final class SignUpInput
{
    /**
     * @var UserName
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var InputPassword
     */
    private $password;

    /**
     * @var Age
     */
    private $age;

    /**
     * コンストラクタ
     *
     * @param UserName $name
     * @param Email $email
     * @param InputPassword $password
     * @param Age $age
     */
    public function __construct(
        UserName $name,
        Email $email,
        InputPassword $password,
        Age $age
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->age = $age;
    }

    /**
     * @return UserName
     */
    public function name(): UserName
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return InputPassword
     */
    public function password(): InputPassword
    {
        return $this->password;
    }

    /**
     * @return Age
     */
    public function age(): Age
    {
        return $this->age;
    }
}