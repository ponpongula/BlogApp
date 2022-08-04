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
$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];

$stmt = $pdo->prepare("UPDATE blogs SET title = :title, content = :content WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':content', $content, PDO::PARAM_STR);
$stmt->execute();
header("Location:index.php");
exit();
?>