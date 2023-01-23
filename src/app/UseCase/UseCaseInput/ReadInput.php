<?php
/**
 * リードユースケースの入力値
 */
final class ReadInput
{
    private $searchWord;
    private $sortOrder;

    public function __construct(?string $searchWord, ?string $sortOrder)
    {
        $this->searchWord = $searchWord;
        $this->sortOrder = $sortOrder;
    }

    public function searchWord(): ?string
    {
        return $this->searchWord;
    }

    public function sortOrder(): ?string
    {
        return $this->sortOrder;
    }
}
?>