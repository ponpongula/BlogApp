<?php
session_start();
require_once '../app/Lib/redirect.php';
require_once '../app/Infrastructure/Dao/UserDao.php';

$email = filter_input(INPUT_POST, 'email');
$UserDao = new UserDao();
$member = $UserDao->findByEmail($email); 
if (empty($_POST['email']) && empty($_POST['password'])) {
  echo "Eメールとパスワードを入力してください";
} elseif ($_POST['password'] === $member['password']) {
  $_SESSION['id'] = $member['id'];
  $_SESSION['name'] = $member['name'];
  redirect("index.php");
} else {
  echo 'メールアドレスもしくはパスワードが間違っています。';
  echo '<a href="signin.php">戻る</a>';
}
?>