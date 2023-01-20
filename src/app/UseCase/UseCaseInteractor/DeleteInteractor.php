<?php
require_once __DIR__ . '/../UseCaseInput/DeleteInput.php';
require_once __DIR__ . '/../UseCaseOutput/DeleteOutput.php';

final class DeleteInteractor
{
    private $input;
    private $blogDao;

    public function __construct(DeleteInput $input, BlogDao $blogDao) 
    {
        $this->input = $input;
        $this->blogDao = $blogDao;
    }

    public function handler(): DeleteOutput
    {
        $this->blogDao->delete($this->input->blogid());
  
        return new DeleteOutput(true);
    }

}