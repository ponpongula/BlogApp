<?php
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogContent.php';

/**
 * コメントユースケースの入力値
 */
final class CommentInput
{
    /**
     * @var string
     */
    private $user_id;

    /**
     * @var string
     */
    private $blog_id;

    /**
     * @var string
     */
    private $commenter_name;

    /**
     * @var string
     */
    private $comment;

    /**
     * コンストラクタ
     *
     * @param string $user_id
     * @param string $title
     * @param string $content
     * @param string $comment
     */
    public function __construct(string $user_id, string $blog_id, string $commenter_name, string $comment)
    {
        $this->user_id = $user_id;
        $this->blog_id = $blog_id;
        $this->commenter_name = $commenter_name;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function user_id(): string
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function blog_id(): string
    {
        return $this->blog_id;
    }

    /**
     * @return string
     */
    public function commenter_name(): string
    {
        return $this->commenter_name;
    }

    /**
     * @return string
     */
    public function comment(): string
    {
        return $this->comment;
    }
}