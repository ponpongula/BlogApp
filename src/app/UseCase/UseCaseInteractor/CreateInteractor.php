<?php
require_once __DIR__ . '/../UseCaseInput/CreateInput.php';
require_once __DIR__ . '/../UseCaseOutput/CreateOutput.php';

final class CreateInteractor
{
    private $blogDao;
    private $input;

    public function __construct(CreateInput $input) {
        $this->blogDao = new BlogDao;
        $this->input = $input;
    }

    public function handler(): CreateOutput
    {

        $blogDao->create(
          $this->input->user_id(), 
          $this->input->title(), 
          $this->input->content()
        );
    
        return new CreateOutput(true);
    }

}