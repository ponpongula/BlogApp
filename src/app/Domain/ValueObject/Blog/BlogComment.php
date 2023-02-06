<?php
/**
 * ブログのコメントのValueObject
 */
final class BlogComment
{
    /**
     * 内容不正な場合のエラーメッセージ
     */
    const INVALID_MESSAGE = '内容は120文字以下でお願いします！';

    /**
     * @var string
     */
    private $value;

    /**
     * コンストラクタ
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if ($this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * コメントのバリデーション
     *
     * @param string $value
     * @return boolean
     */
    private function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 120;
    }
}