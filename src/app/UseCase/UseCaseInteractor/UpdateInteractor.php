<?php
require_once __DIR__ . '/../UseCaseInput/UpdateInput.php';
require_once __DIR__ . '/../UseCaseOutput/UpdateOutput.php';

final class UpdateInteractor
{
    private $blogDao;
    private $input;

    public function __construct(UpdateInput $input) {
        $this->blogDao = new BlogDao;
        $this->input = $input;
    }

    public function handler(): UpdateOutput
    {
        $this->blogDao->update(
          $this->input->id(), 
          $this->input->title(), 
          $this->input->content()
        );
    
        return new UpdateOutput(true);
    }

}