<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$successRegistedMessage = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="ja">

<style>
  .table {
    height: 100vh;
    display: grid;
    place-items: center;
  }
</style>
<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p class="text-red-600"><?php echo $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<form action="signup_save.php" method="post">
  <table align="center">
    <tr>
      <td><h2>新規会員登録</h2>
    </tr>

    <tr>
      <td><input type="text" name="name" placeholder="ユーザーネーム"></td>
    </tr>

    <tr>
      <td><input type="text" name="email" placeholder="Eメール"></td>
    </tr>

    <tr>
      <td><input type="password" name="password" placeholder="パスワード"></td>
    </tr>

    <tr>
      <td><input type="password" name="confirmPassword" placeholder="パスワード確認"></td>
    </tr>
    
    <tr>
      <td><input type="submit" value="登録"></td>
    </tr>

    <tr>
      <td><a href="signin.php">ログイン画面へ</td>
    </tr>
  </table>
</from>
</html>