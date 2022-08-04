<?php
session_start();
$user_id = $_SESSION['id'];
$title = $_POST["title"];
$content = $_POST["content"];
if (empty($user_id)) {
  header("Location: ./signin.php");
  exit();
}
if (empty($title) and empty($content)) {
  echo "記入漏れがあります";
  echo '<a href="create.php">戻る</a>';
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8',
    $dbUserName,
    $dbPassword
);

$sql = "INSERT INTO blogs(user_id, title, content) VALUES (:user_id, :title, :content)";

$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();
?>
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
  <form action="create.php" method="post">
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