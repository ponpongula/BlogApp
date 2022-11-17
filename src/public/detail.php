<?php 
require_once '../app/Infrastructure/Dao/BlogDao.php';
require_once '../app/Infrastructure/Dao/CommentDao.php';


$id = filter_input(INPUT_GET, 'id');

$BlogDao = new BlogDao();
$blog = $BlogDao->edit($id);

$CommentDao = new CommentDao();
$comments = $CommentDao->fetchAllByBlogId($id);
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

    <form action="comment.php" method="post">
    <input type="hidden" name="blog_id" value="<?php echo $id; ?>">
      <table align="center">

        <tr>
          <td><h1>この投稿にコメントしますか？</h1></td>
        </tr>

        <tr>
          <td>コメント名</td>
          <td><input name="commenter_name" placeholder="コメントタイトル"></td>
        </tr>
        <tr>
          <td>内容</td>
          <td><textarea name="comments" cols="50" rows="10" placeholder="内容"></textarea></td>
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
        <td><h1><?php echo $value['commenter_name']?></h1></td>
      </tr>

      <tr>
        <td><p>投稿日：<?php echo $value['created_at']?></p></td>
      </tr>

      <tr>
        <td><p><?php echo $value['comments']?></p></td>
      </tr><hr>
      
    </table>
  <?php endforeach; ?>
</body>
</html>