
<!DOCTYPE html>
<html lang="ja">

<style>
  .table {
    height: 100vh;
    display: grid;
    place-items: center;
  }
</style>
<form action="signup_save.php" method="post">
  <table align="center">
    <tr>
      <td><h2>新規会員登録</h2>
    </tr>

    <tr>
      <td><p><input type="text" name="name" placeholder="ユーザーネーム"></p></td>
    </tr>

    <tr>
      <td><p><input type="text" name="email" placeholder="Eメール"></p></td>
    </tr>

    <tr>
      <td><p><input type="password" name="password" placeholder="パスワード"></p></td>
    </tr>

    <tr>
      <td><p><input type="password" name="password2" placeholder="パスワード確認"></p></td>
    </tr>
    
    <tr>
      <td><p><input type="submit" value="登録"></p></td>
    </tr>

    <tr>
      <td><p><a href="index.php">ログイン画面へ</p></td>
    </tr>
  </table>
</from>
</html>