<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\ReadInput;
use App\UseCase\UseCaseOutput\ReadOutput;
use App\Infrastructure\Dao\BlogDao;

final class ReadInteractor
{
    private $input;
    private $blogDao;

    public function __construct(ReadInput $input, BlogDao $blogDao)
    {
        $this->input = $input;
        $this->blogDao = $blogDao;
    }

    public function handler(): ReadOutput
    {
        $searchWord = $this->input->searchWord();
        $sortOrder = $this->input->sortOrder();
        $blogs = $this->blogDao->getBlogList($searchWord, $sortOrder);

        return new ReadOutput($blogs);
    }
}
