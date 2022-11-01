<?php

require_once '../app/Lib/pdoint.php';

function blogList(?string $search_word, ?string $sort_order): array
{
	$pdo = pdoInit();

  $sql = "SELECT * FROM blogs WHERE title LIKE '%" . $search_word . "%' OR content LIKE '%" . $search_word . "%' ORDER BY created_at";
  $sql  = $sql . $sort_order;
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
  return($blogs);
}
?>