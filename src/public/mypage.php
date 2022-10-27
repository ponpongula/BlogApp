<?php
require_once '../app/Lib/redirect.php';

session_start();
$user_id = $_SESSION['id'];
if (isset($user_id)) {
  require_once("./header.php");
  $dbUserName = "root";
  $dbPassword = "password";
  $pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);
  $sql = "SELECT * FROM blogs WHERE user_id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $user_id);
  $stmt->execute();
  $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  redirect("signin.php");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>My Pege</title>
</head>

<body>
  <h1>マイページ</h1>
  <button type="button"><a href="create.php">新規作成</a></button>
  <?php foreach ($blogs as $blog) : ?>
    <table align="center">
      <td>
        <tr><p><h2><?php echo $blog['title'] ?></h2></p></tr>
        <tr><p><?php echo $blog['created_at'] ?></p></tr>
        <tr><p><?php echo $blog['content'] ?></p></tr>
        <a href="myarticledetail.php?id=<?php echo $blog['id']; ?>">詳細ページへ</a>
        <hr>
      </td>
    </table>
  <?php endforeach; ?>
</body>
</html>