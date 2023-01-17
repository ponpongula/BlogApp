<?php
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
    public function listAcquisition(): array
    {
        return $this->blogList;
    }
}