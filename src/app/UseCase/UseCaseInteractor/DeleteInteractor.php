<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\DeleteInput;
use App\UseCase\UseCaseOutput\DeleteOutput;

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
        $this->blogDao->delete($this->input->blog_id());
  
        return new DeleteOutput(true);
    }

}