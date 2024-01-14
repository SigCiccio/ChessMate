<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");
require_once("utils/functions.php");

require_once('vmc/Models/UserModel.php');

require_once('vmc/Controllers/ImageController.php');

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\UserModel;

use vmc\Controllers\ImageController;

class UserController
{
    private QueryBuilder $qb;
    private ImageController $ic;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->ic = new ImageController($dbh);
    }

    private function checkData(array $data)
    {
        if(!isset($data['mail']) || !isset($data['username']) || !isset($data['password']) || !isset($data['name']) || !isset($data['surname']) || !isset($data['birthday']))
            return false;
        
        return true;
    }

    private function makeModel(array $data)
    {
        $um = new UserModel($data['username'], $data['mail'], $data['bio'], $data['name'], $data['surname'], $data['birthday'], $data['followers'], $data['follow']);

        if($data['image'] != NULL)
            $um->setImage($this->ic->selectImageById($data['image']));
        
        return $um;
    }

    public function selectUserFromMail(String $mail)
    {
        $res = $this->qb->select('*')
        ->from('users')
        ->where('mail', '=', $mail, 's')
        ->commit();

        if(count($res) == 0)
            return [
                'res' => -1,
                'value' => NULL,
            ];

        return [
            'res' => 0,
            'value' => $this->makeModel($res[0]),
        ];
    }

    public function selectUserFromUsername(String $username)
    {
        $res = $this->qb->select('*')
        ->from('users')
        ->where('username', '=', $username, 's')
        ->commit();

        if(count($res) == 0)
            return [
                'res' => -1,
                'value' => NULL,
            ];

        return [
            'res' => 0,
            'value' => $this->makeModel($res[0]),
        ];
    }

    public function checkPassword(String $username, $password)
    {
        $res = $this->qb->select('password')
            ->from('users')
            ->where('username', '=', $username, 's')
            ->commit();
        
        return isEqual($password, $res[0]['password']);
    }

    public function insertNewUser(array $data)
    {
        if(!$this->checkData($data))
            return -1;

        $res = $this->qb->insert("`mail`, `password`, `username`, `name`, `surname`, `birthday`")
            ->into('`users`')
            ->value($data['mail'], 's')
            ->value($data['password'], 's')
            ->value($data['username'], 's')
            ->value($data['name'], 's')
            ->value($data['surname'], 's')
            ->value($data['birthday'], 's')
            ->commit();
        echo $res;
    }
    
    public function getFollowers($user)
    {
        return $this->qb->select("followed as author")
            ->from("follows")
            ->where('follower', '=', $username, 's')
            ->commit();
    }
}
