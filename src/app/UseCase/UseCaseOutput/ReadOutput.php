<?php
namespace App\UseCase\UseCaseOutput;

/**
 * リードユースケースの返り値
 */
final class ReadOutput
{
    /**
     * @var array
     */
    private $blogList;

    /**
     * コンストラクタ
     *
     * @param array $blogList
     */
    public function __construct(array $blogList)
    {
        $this->blogList = $blogList;
    }

    /**
     * @return array
     */
    public function blogList(): array
    {
        return $this->blogList;
    }
}