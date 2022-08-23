<style>
  .table {
    height: 100vh;
    display: grid;
    place-items: center;
  }
</style>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Top Pege</title>
</head>

<body>
  <form action="store.php" method="post">
    <table align="center">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >
      <tr>
        <td><h2>新規記事</h2></td>
      </tr>
      <tr>
        <td>タイトル</td>
        <td><input name="title" placeholder="タイトル"></td>
      </tr>
      <tr>
        <td>内容</td>
        <td><textarea name="content" cols="50" rows="10" placeholder="内容"></textarea></td>
      </tr>
      <tr>
        <td><button type="submit" name="button">新規作成</button></td>
      </tr>
    </table>
  </form> 
</body>
</html>