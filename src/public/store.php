<?php
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInput/CreateInput.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInteractor/CreateInteractor.php';
require_once __DIR__ . '/../app/UseCase/UseCaseOutput/CreateOutput.php';

session_start();
$user_id = $_SESSION['user']['id'];
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
try {
  if (empty($title) && empty($content)) {
      throw new Exception('タイトルと内容を入力してください');
  } 
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