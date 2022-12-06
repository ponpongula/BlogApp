<?php
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';

session_start();
$user_id = $_SESSION['user']['id'];
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');
if (empty($user_id)) {
  redirect("user/signin.php");
}

if (isset($title) and isset($content)) {
  $BlogDao = new BlogDao();
  $BlogDao->create($user_id, $title, $content);
  redirect("index.php");
  exit();
} else {
  echo "記入漏れがあります";
  echo '<a href="create.php">戻る</a>';
}
?>