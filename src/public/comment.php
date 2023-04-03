<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogComment;
use App\Infrastructure\Dao\CommentDao;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\BlogDao;
use App\UseCase\UseCaseInput\CommentInput;
use App\UseCase\UseCaseInteractor\CommentInteractor;
use App\UseCase\UseCaseInteractor\CommentOutput;

session_start();
$user_id = $_SESSION['user']['id'];
$blog_id = filter_input(INPUT_POST, 'blog_id');
$commenter_name = $_SESSION['user']['name'];
$comment = filter_input(INPUT_POST, 'comment');
try {
  if (empty($comment)) {
      throw new Exception('コメント内容を入力してください');
  } 
  $UserId = new UserId($user_id);
  $BlogId = new BlogId($blog_id);
  $CommenterName = new UserName($commenter_name);
  $BlogComment = new BlogComment($comment);
  $useCaseInput = new CommentInput($UserId, $BlogId, $CommenterName, $BlogComment);
  $commentDao = new CommentDao();
  $userDao = new UserDao();
  $blogDao = new BlogDao();
  $useCase = new CommentInteractor($useCaseInput, $commentDao, $userDao, $blogDao);
  $useCaseOutput = $useCase->handler();
  if (!$useCaseOutput->isSuccess()) {
    throw new Exception('ユーザーまたは、ブログが存在しません');
  }
  redirect("detail.php?id=$blog_id");
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  redirect("detail.php?id=$blog_id");
}