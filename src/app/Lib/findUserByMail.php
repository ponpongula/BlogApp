<?php

require_once '../app/Lib/pdoint.php';

function findUserByMail(string $email): ?array
{
	$pdo = pdoInit();

	$sql = "SELECT * FROM users WHERE email = :email";
	$statement = $pdo->prepare($sql);
	$statement->bindValue(':email', $email, PDO::PARAM_STR);
	$statement->execute();
	$user = $statement->fetch(PDO::FETCH_ASSOC);

	if (!$user) {
		return null;
	}
	return $user;
	
}

?>