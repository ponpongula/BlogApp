<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContent;
use App\Infrastructure\Dao\BlogDao;
use App\UseCase\UseCaseInput\UpdateInput;
use App\UseCase\UseCaseInteractor\UpdateInteractor;
use App\UseCase\UseCaseInteractor\UpdateOutput;

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