<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<style type="text/css">
  header {
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
</style>
<body>
  <header>
    <h1 class="title">こんにちは!<?php echo $_SESSION['user']['name']; ?>さん</h1>
    <nav class="nav">
      <ul class="menu-group">
        <li class="menu-item"><a href="index.php">ホーム</a></li>
        <li class="menu-item"><a href="mypage.php">マイページ</a></li>
        <li class="menu-item"><a href="user/logout.php">ログアウト</a></li>
      </ul>
    </nav>
  </header>
  <hr>
</body>
</html>