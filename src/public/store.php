<?php
require_once '../app/Lib/redirect.php';

session_start();
$user_id = $_SESSION['id'];
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
if (empty($user_id)) {
  redirect("signin.php");
}

if (isset($title) and isset($content)) {
  $dbUserName = 'root';
  $dbPassword = 'password';
  $pdo = new PDO(
      'mysql:host=mysql; dbname=blog; charset=utf8',
      $dbUserName,
      $dbPassword
  );

  $sql = "INSERT INTO blogs(user_id, title, content) VALUES (:user_id, :title, :content)";

  $statement = $pdo->prepare($sql);
  $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $statement->bindValue(':title', $title, PDO::PARAM_STR);
  $statement->bindValue(':content', $content, PDO::PARAM_STR);
  $statement->execute();
  redirect("index.php");
  exit();
} else {
  echo "記入漏れがあります";
  echo '<a href="create.php">戻る</a>';
}
?>