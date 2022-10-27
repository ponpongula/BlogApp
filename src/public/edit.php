<?php
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO(
  "mysql:host=mysql; dbname=blog; charset=utf8", 
  $dbUserName, 
  $dbPassword
);

$id = filter_input(INPUT_GET, 'id');

$sql = "SELECT * FROM blogs WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$blog = $statement->fetchAll(PDO::FETCH_ASSOC);

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