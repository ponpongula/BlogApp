<?php
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogContent.php';

/**
 * アップデートユースケースの入力値
 */
final class UpdateInput
{
    /**
     * @var BlogId
     */
    private $blog_id;

    /**
     * @var BlogTitle
     */
    private $title;

    /**
     * @var BlogContent
     */
    private $content;

    /**
     * コンストラクタ
     *
     * @param BlogId $blog_id
     * @param BlogTitle $title
     * @param BlogContent $content
     */
    public function __construct(BlogId $blog_id, BlogTitle $title, BlogContent $content)
    {
        $this->blog_id = $blog_id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @param BlogId
     */
    public function blog_id(): BlogId
    {
        return $this->blog_id;
    }

    /**
     * @param BlogTitle
     */
    public function title(): BlogTitle
    {
        return $this->title;
    }

    /**
     * @param BlogContent
     */
    public function content(): BlogContent
    {
        return $this->content;
    }
}