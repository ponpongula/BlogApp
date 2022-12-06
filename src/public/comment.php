<?php
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/CommentDao.php';

session_start();
$user_id = $_SESSION['user']['id'];
$blog_id = filter_input(INPUT_POST, 'blog_id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');

$commentDao = new commentDao();
$commentDao->create($user_id, $blog_id, $commenter_name, $comments);
redirect('index.php');
?>