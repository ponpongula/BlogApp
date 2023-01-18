<?php
/**
 * リードユースケースの入力値
 */
final class ReadInput
{
    private $searchWord;

    public function __construct(?string $searchWord)
    {
        $this->searchWord = $searchWord;
    }

    public function searchWord(): ?string
    {
        return $this->searchWord;
    }

    public function sortOrder(?string $sortOrder): ?string
    {
        return $sortOrder;
    }
}
?>