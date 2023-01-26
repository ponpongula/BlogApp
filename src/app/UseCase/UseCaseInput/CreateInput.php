<?php
require_once __DIR__ . '/../../Domain/ValueObject/Blog/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogContent.php';
/**
 * クリエイトユースケースの入力値
 */
final class CreateInput
{
    /**
     * @var UserId
     */
    private $user_id;

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
     * @param UserId $user_id
     * @param BlogTitle $title
     * @param BlogContent $content
     */
    public function __construct(UserId $user_id, BlogTitle $title, BlogContent $content)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return UserId
     */
    public function user_id(): UserId
    {
        return $this->user_id;
    }

    /**
     * @return BlogTitle
     */
    public function title(): BlogTitle
    {
        return $this->title;
    }

    /**
     * @return BlogContent
     */
    public function content(): BlogContent
    {
        return $this->content;
    }
}