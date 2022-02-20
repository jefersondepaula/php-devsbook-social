<?php


class UserRelation
{
    public $id;
    public $user_from;
    public $user_to;

}

interface UserRelationDAO
{
    public function insertRelation(UserRelation $u);
    public function getRelationFrom($id);
}