<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogSortOrder;
use App\Domain\ValueObject\Blog\BlogSearchWord;
use App\Infrastructure\Dao\BlogDao;
use App\UseCase\UseCaseInput\ReadInput;
use App\UseCase\UseCaseInteractor\ReadInteractor;
use App\UseCase\UseCaseInteractor\ReadOutput;

session_start();
if (empty($_SESSION['user']['id'])) {
    redirect('user/signin.php');
}

$searchWord = filter_input(INPUT_GET, 'search');
if (!$searchWord) {
    $searchWord = '';
}

$order = filter_input(INPUT_GET, 'order');
if (!$order) {
    $sortOrder = ' ' . $order;
} else {
    $sortOrder = ' desc';
}
$BlogSearchWord = new BlogSearchWord($searchWord);
$BlogSortOrder = new BlogSortOrder($sortOrder);
$useCaseInput = new ReadInput($BlogSearchWord, $BlogSortOrder);
$blogDao = new BlogDao();
$useCase = new ReadInteractor($useCaseInput, $blogDao);
$useCaseOutput = $useCase->handler();
$blogs = $useCaseOutput->blogList();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Top Pege</title>
</head>

<?php require_once __DIR__ . '/header.php'; ?>

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
  .menu-item { 
  list-style: none;
  display: inline-block;
  padding: 10px;
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
    <?php foreach ($blogs as $blog): ?>
      <table>
        <td>
          <p><tr><h2><?php echo $blog['title']; ?></h2></tr></p>
          <p><tr><?php echo $blog['created_at']; ?></tr></p>
          <p><tr><?php echo $blog['content']; ?></tr></p>
          <p><tr><a href="detail.php?id=<?php echo $blog[
              'id'
          ]; ?>">詳細ページへ</a></tr></p>
          <hr>
        </td>
      </table>
      <?php endforeach; ?>
    </form>
  
</body>
</html>