<?php

require_once 'models/Post.php';
require_once 'dao/UserRelationDaoMysql.php';
require_once 'dao/UserDaoMysql.php';

class PostDaoMysql implements PostDAO
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(Post $p)
    {
        $sql = $this->pdo->prepare("INSERT INTO posts (
            user_id, type, body, createdAt
        ) VALUES (
            :user_id, :type, :body, :createdAt    
        )");

        $sql->bindValue(':user_id', $p->id_user);
        $sql->bindValue(':type', $p->type);
        $sql->bindValue(':body', $p->postBody);
        $sql->bindValue(':createdAt', $p->created_at);
        $sql->execute();
    }

    public function getUserFeed($user_id)
    {
        $result = [];

        // get user list followed by me
        $userRelationDao = new UserRelationDaoMysql($this->pdo);
        $userList = $userRelationDao->getRelationFrom($user_id);

        // get post from users sort by date
        $sql = $this->pdo->query('SELECT * FROM posts 
        WHERE user_id IN (' .implode(',', $userList). ') 
        ORDER BY createdAt DESC');

        if ($sql->rowCount() > 0){
            $post_list = $sql->fetchAll(PDO::FETCH_ASSOC);

            // results to object
            $result = $this->_listPostToObject($post_list, $user_id);
        }

        return $result;
    }

    private function _listPostToObject($post_list, $user_id)
    {
        $posts = [];

        $userDao = new UserDaoMysql($this->pdo);

        foreach ($post_list as $post){
            $newPost = new Post();
            $newPost->id = $post['id'];
            $newPost->created_at = $post['createdAt'];
            $newPost->postBody = $post['body'];
            $newPost->type = $post['type'];
            $user_id == $post['user_id'] ? $newPost->mine = true : $newPost->mine = false;

            // Get info from user
            $newPost->user = $userDao->findById($post['user_id']);

            // Get comments info
            $newPost->comments = [];

            // Get likes info
            $newPost->likes = 0;
            $newPost->liked = false;

            $posts[] = $newPost;
        }

        return $posts;
    }
}