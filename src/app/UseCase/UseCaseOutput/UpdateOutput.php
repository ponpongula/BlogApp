<?php
namespace App\UseCase\UseCaseOutput;

/**
 * アップデートユースケースの返り値
 */
final class UpdateOutput
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