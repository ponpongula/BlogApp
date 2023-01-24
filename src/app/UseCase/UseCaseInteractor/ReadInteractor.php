<?php
require_once __DIR__ . '/../UseCaseInput/ReadInput.php';
require_once __DIR__ . '/../UseCaseOutput/ReadOutput.php';

final class ReadInteractor
{
    private $input;
    private $blogDao;

    public function __construct(ReadInput $input, BlogDao $blogDao) {
        $this->input = $input;
        $this->blogDao = $blogDao;
    }

    public function handler(): ReadOutput
    {
        $searchWord = $this->input->searchWord();
        $sortOrder = $this->input->sortOrder();
        $blogs = $this->blogDao->getBlogList($searchWord, $sortOrder);

        return new ReadOutput($blogs);
    }

}