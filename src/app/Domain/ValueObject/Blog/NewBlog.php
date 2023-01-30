<?php
require_once __DIR__ . 'BlogId.php';
require_once __DIR__ . '/../User/UserId.php';
require_once __DIR__ . 'BlogTitle.php';
require_once __DIR__ . 'BlogContent.php';

/**
 * 新規ブログ登録のValueObject
 */
final class NewBlog
{
    private BlogId $BlogId;
    private UserId $UserId;
    private Title $Title;
    private Content $Content;

    public function __construct(
        BlogId $BlogId,
        UserId $UserId,
        Title $Title,
        Content $Content
    ) {
        $this->BlogId = $BlogId;
        $this->UserId = $UserId;
        $this->Title = $Title;
        $this->Content = $Content;
    }

    /**
     * @return BlogId
     */
    public function BlogId(): BlogId
    {
        return $this->BlogId;
    }

    /**
     * @return UserId
     */
    public function UserId(): UserId
    {
        return $this->UserId;
    }

    /**
     * @return Title
     */
    public function Title(): Title
    {
        return $this->Title;
    }

    /**
     * @return Content
     */
    public function Content(): Content
    {
        return $this->Content;
    }
}