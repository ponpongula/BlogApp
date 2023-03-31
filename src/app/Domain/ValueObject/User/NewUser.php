<?php
namespace App\Domain\ValueObject\User;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\Email;
use App\Domain\ValueObject\User\InputPassword;

/**
 * 新規ユーザー登録のValueObject
 */
final class NewUser
{
    private UserName $name;
    private Email $email;
    private InputPassword $password;

    public function __construct(
        UserName $name,
        Email $email,
        InputPassword $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
}
