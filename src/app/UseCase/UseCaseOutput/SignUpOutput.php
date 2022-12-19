<?php
/**
 * ユーザー登録ユースケースの出力値
 */
final class SignUpOutput
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * コンストラクタ
     *
     * @param boolean $isSuccess
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
