<?php
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogId.php';

/**
 * デリートユースケースの入力値
 */
final class DeleteInput
{
    /**
     * @var BlogId
     */
    private $id;

    /**
     * コンストラクター
     * 
     * @param BlogId $id 
     */
    public function __construct(BlogId $id)
    {
        $this->blogid = $id;
    }

    /**
     * @return BlogId
     */
    public function blog_id(): BlogId
    {
        return $this->blog_id;
    }
}