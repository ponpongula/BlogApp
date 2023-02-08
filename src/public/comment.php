<?php
require_once __DIR__ . '/../app/Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../app/Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogComment.php';
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/CommentDao.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInput/CommentInput.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInteractor/CommentInteractor.php';
require_once __DIR__ . '/../app/UseCase/UseCaseOutput/CommentOutput.php';

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