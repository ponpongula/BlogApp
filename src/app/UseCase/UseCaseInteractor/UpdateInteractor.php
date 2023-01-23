<?php
require_once __DIR__ . '/../UseCaseInput/UpdateInput.php';
require_once __DIR__ . '/../UseCaseOutput/UpdateOutput.php';

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
          $this->input->id(), 
          $this->input->title(), 
          $this->input->content()
        );
    
        return new UpdateOutput(true);
    }

}