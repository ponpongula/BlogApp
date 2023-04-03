<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\User\UserId;
use App\Infrastructure\Dao\BlogDao;

session_start();
$id = $_SESSION['user']['id'];
$UserId = new UserId($id);
$BlogDao = new BlogDao();
$myblog = $BlogDao->fetchAllByUserId($UserId);
require_once('header.php');
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