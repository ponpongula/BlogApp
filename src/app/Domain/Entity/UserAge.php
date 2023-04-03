<?php
namespace App\Domain\Entity;

/**
 * ユーザーのEntity
 */
final class UserAge
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var Age
     */
    private $age;

    /**
     * コンストラクタ
     *
     * @param UserId $id
     * @param Age $age
     */
    public function __construct(UserId $id, Age $age)
    {
        $this->id = $id;
        $this->age = $age;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return Age
     */
    public function age(): Age
    {
        return $this->age;
    }
}