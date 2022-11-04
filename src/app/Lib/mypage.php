<?php
require_once '../app/Lib/pdoint.php';

function mypage(string $user_id): array
{
  $pdo = pdoInit();

  $sql = "SELECT * FROM blogs WHERE user_id = :user_id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':user_id', $user_id);
  $statement->execute();
  $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $blogs;
}
?>