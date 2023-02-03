<?php
/**
 * ブログソートのValueObject
 */
final class BlogSortOrder
{
  /**
   * ブログソートの不正な場合のエラーメッセージ
   */
  const INVALID_MESSAGE = '不正な値です';

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
      if (!$value ===  'DESC' || !$value === 'ASC') {
        if (!is_null($value)) throw new Exception(self::INVALID_MESSAGE);
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
}