<?php
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';

session_start();
$user_id = $_SESSION['user']['id'];
if (!$user_id) {
  redirect("user/signin.php");
} 

$BlogDao = new BlogDao();
$myblog = $BlogDao->fetchAllByUserId($user_id);

require_once("header.php");
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
  <?php foreach ($myblog as $blog) : ?>
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