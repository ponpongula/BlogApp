<?php
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogComment.php';
/**
 * コメントユースケースの入力値
 */
final class CommentInput
{
    /**
     * @var UserId
     */
    private $user_id;

    /**
     * @var BlogId
     */
    private $blog_id;

    /**
     * @var UserName
     */
    private $commenter_name;

    /**
     * @var BlogComment
     */
    private $comment;

    /**
     * コンストラクタ
     *
     * @param UserId $user_id
     * @param BlogId $title
     * @param UserName $content
     * @param BlogComment $comment
     */
    public function __construct(
        UserId $user_id, 
        BlogId $blog_id, 
        UserName $commenter_name, 
        BlogComment $comment
    ){
        $this->user_id = $user_id;
        $this->blog_id = $blog_id;
        $this->commenter_name = $commenter_name;
        $this->comment = $comment;
    }

    /**
     * @return UserId
     */
    public function user_id(): UserId
    {
        return $this->user_id;
    }

    /**
     * @return BlogId
     */
    public function blog_id(): BlogId
    {
        return $this->blog_id;
    }

    /**
     * @return UserName
     */
    public function commenter_name(): UserName
    {
        return $this->commenter_name;
    }

    /**
     * @return BlogComment
     */
    public function comment(): BlogComment
    {
        return $this->comment;
    }
}