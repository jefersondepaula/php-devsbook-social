<?php
require 'config.php';
require 'models/Auth.php';
require 'dao/PostDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$postBody = filter_input(INPUT_POST, 'postBody');

if ($postBody){

    $postDao = new PostDaoMysql($pdo);
    $newPost = new Post();

    $newPost->id_user = $userInfo->id;
    $newPost->type = 'text';
    $newPost->created_at = date('Y-m-d H:i:s');
    $newPost->postBody = $postBody;

    $postDao->insert($newPost);
}

header('Location: '.$base);
exit;
