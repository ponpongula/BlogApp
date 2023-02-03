<?php
require_once __DIR__ . '/BlogId.php';
require_once __DIR__ . '/../User/UserId.php';
require_once __DIR__ . '/BlogTitle.php';
require_once __DIR__ . '/BlogContent.php';

/**
 * 新規ブログ登録のValueObject
 */
final class NewBlog
{
    /**
     * @var BlogId
     */
    private $UserId;

    /**
     * @var UserId
     */
    private $BlogId;

    /**
     * @var BlogTitle
     */
    private $BlogTitle;

    /**
     * @var BlogContent
     */
    private $BlogContent;

    public function __construct(
        BlogId $BlogId,
        UserId $UserId,
        BlogTitle $BlogTitle,
        BlogContent $BlogContent
    ) {
        $this->BlogId = $BlogId;
        $this->UserId = $UserId;
        $this->BlogTitle = $BlogTitle;
        $this->BlogContent = $BlogContent;
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
     * @return BlogTitle
     */
    public function BlogTitle(): BlogTitle
    {
        return $this->BlogTitle;
    }

    /**
     * @return BlogContent
     */
    public function BlogContent(): BlogContent
    {
        return $this->BlogContent;
    }
}