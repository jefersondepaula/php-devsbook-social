<?php

require_once 'models/UserRelation.php';

class UserRelationDaoMysql implements UserRelationDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertRelation(UserRelation $u)
    {
        // TODO: Implement insertRelation() method.
    }

    public function getRelationFrom($id)
    {
        $users = [$id];

        $sql = $this->pdo->prepare('SELECT userTo FROM userrelations WHERE userFrom = :userFrom');
        $sql->bindValue(':userFrom', $id);
        $sql->execute();

        if ($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_BOTH);

            foreach ($data as $user){
                $users[] = $user['userTo'];
            }
        }

        return $users;
    }
}