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
      <td>
        <h2>ログインページ</h2>
      </td>
    </tr>

    <tr>
      <td>
        <input type="text" name="email" placeholder="Eメール">
      </td>
    </tr>

    <tr>
      <td>
        <input type="password" name="password" placeholder="パスワード">
      </td>
    </tr>
    
    <tr>
      <td>
        <input type="submit" value="ログイン">
      </td>
    </tr>

    <tr>
      <td>
        <a href="signup.php">アカウントを作る
      </td>
    </tr>
  </table>
</from>
</html>