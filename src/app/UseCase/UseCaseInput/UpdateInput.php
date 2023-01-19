<?php
/**
 * アップデートユースケースの入力値
 */
final class UpdateInput
{
    private $id;
    private $title;
    private $content;

    public function __construct(string $id, string $title, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }
}