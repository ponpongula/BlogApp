<?php
namespace App\UseCase\UseCaseOutput;

/**
 * ログインユースケースの返り値
 */
final class SignInOutput
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * コンストラクタ
     *
     * @param bool $isSuccess
     */
    public function __construct(bool $isSuccess)
    {
        $this->isSuccess = $isSuccess;
    }

    /**
     * @return boolean
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}