<?php
require_once __DIR__ . '/../UseCaseInput/DeleteInput.php';
require_once __DIR__ . '/../UseCaseOutput/DeleteOutput.php';

final class DeleteInteractor
{
    private $blogDao;
    private $input;

    public function __construct(DeleteInput $input) 
    {
        $this->blogDao = new BlogDao;
        $this->input = $input;
    }

    public function handler(): DeleteOutput
    {
        $this->blogDao->delete($this->input->blogid());
  
        return new DeleteOutput(true);
    }

}