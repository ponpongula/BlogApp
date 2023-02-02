<?php
/**
 * ブログ検索のValueObject
 */
final class BlogSearchWord
{
    /**
     * ブログ検索ワードの不正な場合のエラーメッセージ
     */
    const INVALID_MESSAGE = '50文字以下でお願いします！';

    /**
     * @var string | NULL
     */
    private $value;

    /**
     * コンストラクタ
     *
     * @param string | NULL
     */
    public function __construct(?string $value)
    {
        if ($this->isInvalid($value)) {
            if (!$value === "") throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    /**
     * @return string | NULL
     */
    public function value(): ?string
    {
        return $this->value;
    }

    /**
     * ブログ検索ワードのバリデーション
     *
     * @param string | NULL
     * @return boolean
     */
    private function isInvalid(?string $value): bool
    {
        return mb_strlen($value) > 50;
    }
}