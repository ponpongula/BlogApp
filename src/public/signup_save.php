<?php
require_once '../app/Lib/createUser.php';
require_once '../app/Lib/findUserByMail.php';
require_once '../app/Infrastructure/Dao/UserDao.php';
// require_once __DIR__ . '/../vendor/autoload.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

if (empty($name) && empty($email) && empty($password)) {
  echo "<font color='#f00'>「ユーザーネーム」「Email」「パスワード」を入力してください</font>";
  echo '<a href="signup.php">戻る</a>';
} else {
  if (empty($password) || empty($confirmPassword)) {
    echo "<font color='#f00'>パスワードが入力されていません</font>";
    echo '<a href="signup.php">戻る</a>';
  } elseif ($password !== $confirmPassword) {
    echo "<font color='#f00'>パスワードが一致しません</font>";
    echo '<a href="signup.php">戻る</a>';
  }

  // $user = findUserByMail($email);
  $UserDao = new UserDao();
  $user = $UserDao->findByEmail($email);
  
  if ($user['email'] === $email) {
    echo "<font color='#f00'>メールアドレスが複重しています</font>";
    echo '<a href="signup.php">戻る</a>';
  } else {
    $UserDao->create($name, $email, $password);
    echo "登録が完了しました";
    echo '<a href="signin.php">ログイン画面へ</a>';
  }
}
?>