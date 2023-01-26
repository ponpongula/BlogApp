<?php
/**
 * ブログソートのValueObject
 */
{
  /**
   * ブログソートの不正な場合のエラーメッセージ
   */
  const INVALID_MESSAGE = '不正な値です';
  const SORT_ORDER_DESC = 'DESC';
  const SORT_ORDER_ASC = 'ASC';

  /**
   * @var string
   */
  private $value;

  /**
   * コンストラクタ
   *
   * @param string | NULL
   */
  public function __construct(?string $value)
  {
      if (!self::SORT_ORDER_DESC === $value || !self::SORT_ORDER_ASC === $value) {
          throw new Exception(self::INVALID_MESSAGE);
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