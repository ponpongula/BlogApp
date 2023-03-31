<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogId;
use App\Infrastructure\Dao\BlogDao;

session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$successRegistedMessage = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$id = filter_input(INPUT_GET, 'id');
$BlogId = new BlogId($id);
$BlogDao = new BlogDao();
$blog = $BlogDao->edit($BlogId);
?>

<!DOCTYPE html>
<html lang="ja">

<body>
	<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p class="text-red-600"><?php echo $error; ?></p>
    <?php endforeach; ?>
  <?php endif; ?>
	<p class="text-red-600"><?php echo $successRegistedMessage; ?></p>
	<form action="update.php" method="post">
		<table align="center">
			<input type="hidden" name="id" value="<?php echo $id; ?>" >
			<tr>
				<td><p>タイトル</p></td>
				<td><p><input type="text" name="title" value="<?php echo $blog[0]['title']; ?>"></p></td>
			</tr>

			<tr>
				<td><p>本文</p></td>
				<td><p><textarea type="form-control" name="content"><?php echo $blog[0]['content']; ?></textarea></p></td>
			</tr>
			
			<tr>
				<td><p><input type="submit" value="編集" id="edit" name="edit"></p></td>
			</tr>
		</table>
	</form>
</body>
</html>