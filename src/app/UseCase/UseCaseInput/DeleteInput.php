<?php
final class DeleteInput
{
  private $id;

  public function __construct(string $id)
  {
      $this->blogid = $id;
  }

  public function blogid(): string
  {
      return $this->blogid;
  }
}