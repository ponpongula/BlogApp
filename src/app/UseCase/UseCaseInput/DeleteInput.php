<?php
namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogId;

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
        $this->blog_id = $id;
    }

    /**
     * @return BlogId
     */
    public function blog_id(): BlogId
    {
        return $this->blog_id;
    }
}