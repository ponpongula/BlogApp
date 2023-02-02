<?php
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/CommentDao.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInput/CommentInput.php';
require_once __DIR__ . '/../app/UseCase/UseCaseInteractor/CommentInteractor.php';
require_once __DIR__ . '/../app/UseCase/UseCaseOutput/CommentOutput.php';

session_start();
$user_id = $_SESSION['user']['id'];
$blog_id = filter_input(INPUT_POST, 'blog_id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comment = filter_input(INPUT_POST, 'comment');

$useCaseInput = new CommentInput($user_id, $blog_id, $commenter_name, $comment);
$commentDao = new CommentDao();
$useCase = new CommentInteractor($useCaseInput, $commentDao);
$useCaseOutput = $useCase->handler();
redirect('index.php');