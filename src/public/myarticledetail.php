<?php
require_once __DIR__ . '/../app/Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';

$id = filter_input(INPUT_GET, 'id');
$BlogId = new BlogId($id);
$BlogDao = new BlogDao();
$blog = $BlogDao->edit($BlogId);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>My Pege</title>
</head>

<style>
  .table {
    height: 100vh;
    display: grid;
    place-items: center;
  }
</style>

  <?php foreach ($blog as $value) : ?>
  <table align="center">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <tr>
      <td><h1><?php echo $value['title'] ?></h1></td>
    </tr>

    <tr>
      <td><p><?php echo $value['created_at'] ?></p></td>
      <td><p><?php echo $value['content'] ?></p></td>
    </tr>

    <tr>
      <td><button type="button"><a href="edit.php?id=<?php echo $value['id'];?>">編集</button></td>
      <td><button type="button"><a href="delete.php?id=<?php echo $value['id'];?>">削除</button></td>
      <td><button type="button"><a href="mypage.php">マイページへ</button></td>
    </tr>
  </table>
  <?php endforeach; ?>
</html>