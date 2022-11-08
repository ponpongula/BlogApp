<?php
require_once '../app/Lib/redirect.php';

session_start();
$user_id = $_SESSION['id'];
$blog_id = filter_input(INPUT_POST, 'blog_id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8',
    $dbUserName,
    $dbPassword
);

$sql = "INSERT INTO comments(user_id, blog_id, commenter_name, comments) VALUES (:user_id, :blog_id, :commenter_name, :comments)";

$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$statement->bindValue(':blog_id', $blog_id, PDO::PARAM_STR);
$statement->bindValue(':commenter_name', $commenter_name, PDO::PARAM_STR);
$statement->bindValue(':comments', $comments, PDO::PARAM_STR);
$statement->execute();
redirect("index.php");
?>