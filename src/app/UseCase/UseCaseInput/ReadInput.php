<?php
/**
 * リードユースケースの入力値
 */
final class ReadInput
{
    /**
     * @var BlogSerchWord
     */
    private $searchWord;

    /**
     * @var BlogSortOrder
     */
    private $sortOrder;

    /**
     * コンストラクター
     * 
     * @param BlogSerchWord $searchWord 
     * @param BlogSortOrder $sortOrder 
     */
    public function __construct(?BlogSerchWord $searchWord, ?BlogSortOrder $sortOrder)
    {
        $this->searchWord = $searchWord;
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return BlogSerchWord
     */
    public function searchWord(): ?BlogSerchWord
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