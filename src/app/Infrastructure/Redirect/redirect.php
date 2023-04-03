<?php
namespace App\Infrastructure\Redirect;

function redirect(string $redirectPath): void
{
	header("Location: " . $redirectPath);
	exit;
}

?>