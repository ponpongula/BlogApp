<?php
require_once '../app/Lib/redirect.php';
require_once '../app/Infrastructure/Dao/BlogDao.php';


$id = filter_input(INPUT_POST, 'id');
$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');

$blogDao = new blogDao();
$blogDao->updateBlog($id, $title, $content);
redirect("index.php");
?>