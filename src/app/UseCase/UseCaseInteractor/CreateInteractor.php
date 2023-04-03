<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\NewBlog;
use App\UseCase\UseCaseInput\CreateInput;
use App\UseCase\UseCaseOutput\CreateOutput;

final class CreateInteractor
{
    private $input;
    private $blogDao;

    public function __construct(CreateInput $input, BlogDao $blogDao) {
        $this->input = $input;
        $this->blogDao = $blogDao;
    }

    public function handler(): CreateOutput
    {
        $this->blogDao->create(
            $this->input->user_id(), 
            $this->input->title(), 
            $this->input->content()
        );
    
        return new CreateOutput(true);
    }
}