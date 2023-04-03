<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\UpdateInput;
use App\UseCase\UseCaseOutput\UpdateOutput;

final class UpdateInteractor
{
    private $input;
    private $blogDao;

    public function __construct(UpdateInput $input, BlogDao $blogDao) {
        $this->input = $input;
        $this->blogDao = $blogDao;
    }

    public function handler(): UpdateOutput
    {
        $this->blogDao->update(
          $this->input->blog_id(), 
          $this->input->title(), 
          $this->input->content()
        );
    
        return new UpdateOutput(true);
    }
}