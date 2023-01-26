<?php
require_once __DIR__ . '/../UseCaseInput/ReadInput.php';
require_once __DIR__ . '/../UseCaseOutput/ReadOutput.php';

final class ReadInteractor
{
    private $input;

    public function __construct(ReadInput $input) {
        $this->input = $input;
    }

    public function handler(): ReadOutput
    {
        if (!$searchWord) {
          $searchWord = "";
        }
        
        if ($_GET['order'] === 'desc') {
          $sortOrder = ' DESC';
        } elseif ($_GET['order'] === 'asc') {
          $sortOrder = ' ASC';
        }
        
        $blogDao = new BlogDao;
        $blogs = $blogDao->getBlogList($this->input->searchWord(), $this->input->sortOrder());

        return new ReadOutput($blogs);
    }
}