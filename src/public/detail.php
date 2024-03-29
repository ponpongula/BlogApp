<?php 
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogId;
use App\Infrastructure\Dao\BlogDao;
use App\Infrastructure\Dao\CommentDao;

session_start();
$id = filter_input(INPUT_GET, 'id');
$BlogId = new BlogId($id);
$BlogDao = new BlogDao();
$blog = $BlogDao->edit($BlogId);

$CommentDao = new CommentDao();
$comments = $CommentDao->fetchAllByBlogId($BlogId);

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$successRegistedMessage = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Detail Pege</title>
</head>

<style type="text/css">

</style>
<body>
    <?php foreach ($blog as $value) : ?>
      <table align="center">
        <tr>
          <td><h1><?php echo $value['title']?></h1></td>
        </tr>

        <tr>
          <td><p>投稿日：<?php echo $value['created_at']?></p></td>
        </tr>

        <tr>
          <td><p><?php echo $value['content']?></p></td>
        </tr>

        <tr>
          <td><p><a href="index.php">一覧ページへ</p></td>
        </tr>
      </table><hr>
    <?php endforeach; ?>
    
    <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <p class="text-red-600"><?php echo $error; ?></p>
            <?php endforeach; ?>
    <?php endif; ?>
    <form action="comment.php" method="post">
    <input type="hidden" name="blog_id" value="<?php echo $id; ?>">
      <table align="center">

        <tr>
          <td><h1>この投稿にコメントしますか？</h1></td>
        </tr>
      
        <tr>
          <td>ユーザー名</td>
          <td><?php echo $_SESSION['user']['name']; ?></td>
        </tr>
        <tr>
          <td>内容</td>
          <td><textarea name="comment" cols="50" rows="10" placeholder="内容"></textarea></td>
        </tr>
        <tr>
          <td><button type="submit" name="button">コメント</button></td>
        </tr>
      </table>
    </form><hr>

    <h1 align="center">コメント一覧</h1>
  <?php foreach ($comments as $value) : ?>
    <table align="center">
      <tr>
        <td><?php echo $value['commenter_name']?></td>
      </tr>

      <tr>
        <td><p><?php echo $value['comments']?></p></td>
      </tr>

      <tr>
        <td><p>投稿日：<?php echo $value['created_at']?></p></td>
      </tr><hr>
      
    </table>
  <?php endforeach; ?>
</body>
</html>