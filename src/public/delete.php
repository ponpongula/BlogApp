<?php
require_once __DIR__ . '/../app/Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../app/Infrastructure/Redirect/redirect.php';

$id = filter_input(INPUT_GET, 'id');
$BlogDao = new BlogDao();
$BlogDao->delete($id);
require_once('index.php');
?>