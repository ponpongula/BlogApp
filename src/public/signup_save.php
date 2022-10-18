<?php
require_once '../app/Lib/createUser.php';
require_once '../app/Lib/findUserByMail.php';
require_once '../app/Lib/redirect.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

if (empty($name) && empty($email) && empty($password)) {
  echo '「ユーザーネーム」「Email」「パスワード」を入力してください';
} else {
  if (empty($password) || empty($confirmPassword)) {
    echo "<font color='#f00'>パスワードが入力されていません</font>";
  } elseif ($password !== $confirmPassword) {
    echo "<font color='#f00'>パスワードが一致しません</font>";
    header("Location: singnup.php");
    exit;
  }

  $user = findUserByMail($email);
  if ($user['email'] === $email) {
    echo "<font color='#f00'>メールアドレスが複重しています</font>";
    echo '<a href="signup.php">戻る</a>';
  } else {
    createUser($name, $email, $password);
    print"登録が完了しました";
    echo '<a href="signin.php">ログイン画面へ</a>';
  }
}
?>