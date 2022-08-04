<?php
session_start();
$search_word = $_GET['search'];
if (isset($_SESSION['id'])) {
  require_once("./header.php");
  $dbUserName = "root";
  $dbPassword = "password";
  $pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);
  $sql = "SELECT * FROM blogs WHERE title LIKE '%" . $search_word . "%' OR content LIKE '%" . $search_word . "%' ORDER BY created_at";
  if ($_GET['order'] === 'desc') {
    $sql = $sql . ' DESC';
  } elseif ($_GET['order'] === 'asc') {
    $sql = $sql . ' ASC';
  }
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
  header("Location: ./signin.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Top Pege</title>
</head>

<style type="text/css">
  .header {
  display: flex;
  width: 100%;
  height: 100px;
  align-items: center;
  }
  .title {
  margin-right: auto;
  }
  .menu-item { list-style: none;
  display: inline-block;
  padding: 10px;
  }

  .div {
  border: solid 8px red;
  box-sizing: border-box;

  text-align: center;
  line-height: 100px;
  font-weight: bold;
  font-size: 60px;
  }
</style>
<body>
  <h1>blog一覧</h1>
  <form action="index.php" method="get">
    <input name="search" type="text" value="<?php echo $_GET['search'] ??
        ''; ?>" placeholder="キーワードを入力">
    <label>
      <input type="radio" name="order" value="desc" class="" 
      <?php if (!isset($_GET['order']) || $_GET['order'] == 'desc') {
                echo 'checked';
            } ?>>
      <span>新着順</span>
    </label>
    <label>
      <input type="radio" name="order" value="asc" class="" 
      <?php if (isset($_GET['order']) && $_GET['order'] != 'desc') {
                echo 'checked';
            } ?>>
      <span>古い順</span>
    </label>
  <button type="submit">送信</button>
  </form>
  
 
    <form action="detail.php" method="post">
    <?php foreach ($blogs as $blog) : ?>
      <table>
        <td>
          <p><tr><h2><?php echo $blog['title'] ?></h2></tr></p>
          <p><tr><?php echo $blog['created_at'] ?></tr></p>
          <p><tr><?php echo $blog['content'] ?></tr></p>
          <p><tr><a href="detail.php?id=<?php echo $blog['id']; ?>">詳細ページへ</a></tr></p>
          <hr>
        </td>
      </table>
      <?php endforeach; ?>
    </form>
  
</body>
</html>