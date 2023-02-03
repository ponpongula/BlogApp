<?php
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogSearchWord.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogSortOrder.php';

/**
 * リードユースケースの入力値
 */
final class ReadInput
{
    /**
     * @var BlogSearchWord
     */
    private $searchWord;

    /**
     * @var BlogSortOrder
     */
    private $sortOrder;

    /**
     * コンストラクター
     * 
     * @param BlogSearchWord $searchWord 
     * @param BlogSortOrder $sortOrder 
     */
    public function __construct(?BlogSearchWord $searchWord, ?BlogSortOrder $sortOrder)
    {
        $this->searchWord = $searchWord;
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return BlogSearchWord
     */
    public function searchWord(): ?BlogSearchWord
    {
        return $this->searchWord;
    }

    /**
     * @return BlogSortOrder
     */
    public function sortOrder(): ?BlogSortOrder
    {
        return $this->sortOrder;
    }
}