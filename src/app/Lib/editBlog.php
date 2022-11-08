<?php

require_once '../app/Lib/pdoint.php';

function editBlog(string $id): ?array
{
  $pdo = pdoInit();

  $sql = "SELECT * FROM blogs WHERE id = :id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':id', $id, PDO::PARAM_INT);
  $statement->execute();
  $blog = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $blog;
}

?>