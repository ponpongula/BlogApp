<?php
require_once __DIR__ . '/../UseCaseInput/CommentInput.php';
require_once __DIR__ . '/../UseCaseOutput/CommentOutput.php';

final class CommentInteractor
{
    private $input;
    private $commentDao;

    public function __construct(CommentInput $input, CommentDao $commentDao) {
        $this->input = $input;
        $this->commentDao = $commentDao;
    }

    public function handler(): CommentOutput
    {
        $this->commentDao->create(
            $this->input->user_id(), 
            $this->input->blog_id(), 
            $this->input->commenter_name(),
            $this->input->comment()
        );
    
        return new CommentOutput(true);
    }
}