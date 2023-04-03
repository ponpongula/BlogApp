<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\redirect;
use App\Domain\ValueObject\Blog\BlogId;
use App\Infrastructure\Dao\BlogDao;
use App\UseCase\UseCaseInput\DeleteInput;
use App\UseCase\UseCaseInteractor\DeleteInteractor;
use App\UseCase\UseCaseInteractor\DeleteOutput;

$id = filter_input(INPUT_GET, 'id');
$BlogId = new BlogId($id);
$useCaseInput = new DeleteInput($BlogId);
$blogDao = new BlogDao();
$useCase = new DeleteInteractor($useCaseInput, $blogDao);
$useCaseOutput = $useCase->handler();
require_once('index.php');
?>