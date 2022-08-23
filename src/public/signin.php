<!DOCTYPE html>
<html lang="ja">

<style>
  .table {
    height: 100vh;
    display: grid;
    place-items: center;
  }
</style>
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