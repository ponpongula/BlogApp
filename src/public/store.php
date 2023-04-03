<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContent;
use App\Infrastructure\Dao\BlogDao;
use App\UseCase\UseCaseInput\CreateInput;
use App\UseCase\UseCaseInteractor\CreateInteractor;
use App\UseCase\UseCaseInteractor\CreateOutput;

session_start();
$user_id = $_SESSION['user']['id'];
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
try {
  if (empty($title) && empty($content)) {
      throw new Exception('タイトルと内容を入力してください');
  } 
  $user_id = new UserId($user_id);
  $title = new BlogTitle($title);
  $content = new BlogContent($content);
  $useCaseInput = new CreateInput($user_id, $title, $content);
  $blogDao = new BlogDao();
  $useCase = new CreateInteractor($useCaseInput, $blogDao);
  $useCaseOutput = $useCase->handler();
  redirect('index.php');
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  redirect('create.php');
}
?>