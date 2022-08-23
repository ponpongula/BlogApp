<?php
$dbUserName = "root";
$dbPassword = "password";
$options = [];
$pdo = new PDO(
  "mysql:host=mysql; dbname=blog; charset=utf8", 
  $dbUserName, 
  $dbPassword,
  $options
);
$id = filter_input(INPUT_GET, 'id');

$sql = "SELECT * FROM blogs WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
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

  <?php foreach ($blogs as $blog) : ?>
  <table align="center">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <tr>
      <td><h1><?php echo $blog['title'] ?></h1></td>
    </tr>

    <tr>
      <td><p><?php echo $blog['created_at'] ?></p></td>
      <td><p><?php echo $blog['content'] ?></p></td>
    </tr>

    <tr>
      <td><button type="button"><a href="edit.php?id=<?php echo $blog['id']; ?>">編集</button></td>
      <td><button type="button"><a href="dalet.php">削除</button></td>
      <td><button type="button"><a href="mypage.php">マイページへ</button></td>
    </tr>
  </table>
  <?php endforeach; ?>
</html>