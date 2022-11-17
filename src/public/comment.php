<?php
session_start();
require_once '../app/Lib/redirect.php';
require_once '../app/Infrastructure/Dao/CommentDao.php';

$user_id = $_SESSION['id'];
$blog_id = filter_input(INPUT_POST, 'blog_id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');

$commentDao = new commentDao();
$commentDao->create($user_id, $blog_id, $commenter_name, $comments);
redirect("index.php");
?>