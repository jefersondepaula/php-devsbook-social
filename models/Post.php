<?php

class Post
{
    public $id;
    public $id_user;
    public $type; // text or photo
    public $created_at;
    public $postBody;

}

interface PostDAO
{
    public function insert(Post $p);
    public function getUserFeed($user_id);
}