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
<form action="signin_save.php" method="post">
  <table align="center">
    <tr>
      <td><h2>ログインページ</h2></td>
    </tr>

    <tr>
      <td><p><input type="text" name="email" placeholder="Eメール"></p></td>
    </tr>

    <tr>
      <td><p><input type="password" name="password" placeholder="パスワード"></p></td>
    </tr>
    
    <tr>
      <td><p><input type="submit" value="ログイン"></p></td>
    </tr>

    <tr>
      <td><p><a href="signup.php">アカウントを作る</p></td>
    </tr>

  </table>
</from>
</html>