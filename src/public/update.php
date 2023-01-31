<?php
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogTitle.php';
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInput/UpdateInput.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInteractor/UpdateInteractor.php';
require_once __DIR__ . '/../app/UseCase/UseCaseOutput/UpdateOutput.php';

$id = filter_input(INPUT_POST, 'id');
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
try {
  if (empty($title) || empty($content)) {
      throw new Exception('タイトルと内容を入力してください');
  } 
  $BlogId = new BlogId($id);
  $BLogTitle = new BlogTitle($title);
  $BlogContent = new BlogContent($content);
  $useCaseInput = new UpdateInput($BlogId, $BLogTitle, $BlogContent);
  $blogDao = new BlogDao();
  $useCase = new UpdateInteractor($useCaseInput, $blogDao);
  $useCaseOutput = $useCase->handler();
  redirect('index.php');
} catch (Exception $e) {
  session_start();
  $_SESSION['errors'][] = $e->getMessage();
  redirect("edit.php?id=$id");
}
?>