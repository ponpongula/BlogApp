<?php
require_once __DIR__ . '/../UseCaseInput/CreateInput.php';
require_once __DIR__ . '/../UseCaseOutput/CreateOutput.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/NewBlog.php';

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