<?php

require_once '../app/Lib/pdoint.php';

function editBlog(string $id): void
{
$pdo = pdoInit();

$sql = "SELECT * FROM blogs WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$statement->fetchAll(PDO::FETCH_ASSOC);

?>