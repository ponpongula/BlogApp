<?php
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInput/DeleteInput.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInteractor/DeleteInteractor.php';
require_once __DIR__ . '/../app/UseCase/UseCaseOutput/DeleteOutput.php';

$id = filter_input(INPUT_GET, 'id');
$BlogId = new BlogId($id);
$useCaseInput = new DeleteInput($BlogId);
$blogDao = new BlogDao();
$useCase = new DeleteInteractor($useCaseInput, $blogDao);
$useCaseOutput = $useCase->handler();
require_once('index.php');
?>