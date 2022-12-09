<?php
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';

$id = filter_input(INPUT_GET, 'id');

$BlogDao = new BlogDao();
$blog = $BlogDao->edit($id);
?>

<!DOCTYPE html>
<html lang="ja">

<body>
	<form action="update.php" method="post">
		<table align="center">
			<input type="hidden" name="id" value="<?php echo $id; ?>" >
			<tr>
				<td><p>タイトル</p></td>
				<td><p><input type="text" name="title" value="<?php echo $blog[0]['title']; ?>"></p></td>
			</tr>

			<tr>
				<td><p>本文</p></td>
				<td><p><textarea type="form-control" name="content"><?php echo $blog[0]['title']; ?></textarea></p></td>
			</tr>
			
			<tr>
				<td><p><input type="submit" value="編集" id="edit" name="edit"></p></td>
			</tr>
		</table>
	</form>
</body>
</html>