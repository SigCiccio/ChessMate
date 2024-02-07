<?php

namespace vmc\Controllers;

require_once("Database/DB/QueryBuilder.php");
require_once("utils/DatabaseHelper.php");
require_once("utils/functions.php");

require_once('vmc/Models/UserModel.php');

require_once('vmc/Controllers/NotificationController.php');
require_once('vmc/Controllers/ImageController.php');

use DatabaseHelper;
use Database\DB\QueryBuilder;

use vmc\Models\UserModel;

use vmc\Controllers\NotificationController;
use vmc\Controllers\ImageController;

class UserController
{
    private QueryBuilder $qb;
    private ImageController $ic;
    private NotificationController $nc;

    public function __construct(DatabaseHelper $dbh)  
    {
        $this->qb = new QueryBuilder($dbh);
        $this->ic = new ImageController($dbh);
        $this->nc = new NotificationController($dbh);
    }

    private function makeModel(array $data)
    {
        $followersList = $this->selectFollowersList($data['username']);

        if(count($followersList) != $data['followers'])
            $this->updateFollowers(count($followersList), $data['username']);
        
        $followList = $this->selectFollowList($data['username']);

            if(count($followList) != $data['follow'])
                $this->updateFollow(count($followersList), $data['username']);

        $um = new UserModel($data['username'], $data['mail'], $data['bio'], $data['name'], $data['surname'], $data['birthday']);

        $um->setFollowList($followList);
        $um->setFollowersList($followersList);

        if($data['image'] != NULL)
            $um->setImage($this->ic->selectImageById($data['image']));
        
        return $um;
    }

    private function checkData(array $data)
    {
        if(!isset($data['mail']) || !isset($data['username']) || !isset($data['password']) || !isset($data['name']) || !isset($data['surname']) || !isset($data['birthday']))
            return false;
        
        return true;
    }

    public function selectFollowersList($username)
    {
        $res = $this->qb->select('follower')
            ->from('follows')
            ->where('followed', '=', $username, 's')
            ->commit();
        
        $list = [];

        foreach($res as $r)
        {
            $list[] = $r['follower'];
        }

        return $list;
    }

    public function selectFollowList($username)
    {
        $res = $this->qb->select('followed')
            ->from('follows')
            ->where('follower', '=', $username, 's')
            ->commit();
        
        $list = [];

        foreach($res as $r)
        {
            $list[] = $r['followed'];
        }

        return $list;
    }

    private function updateFollowers(int $n, String $username)
    {
        $this->qb->update()
            ->table('users')
            ->set('followers', $n, 'i')
            ->where('username', $username, 's')
            ->commit();
    }

    private function updateFollow(int $n, String $username)
    {
        $this->qb->update()
            ->table('users')
            ->set('follow', $n, 'i')
            ->where('username', $username, 's')
            ->commit();
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
            return [];

        return $this->makeModel($res[0]);
    }

    public function updatePassword($user, $password)
    {
        return $this->qb->update()->table('users')
            ->set('password', $password, 's')
            ->where('username', $user, 's')
            ->commit();
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

    public function updateUser(array $data, String $user)
    {
        $query = $this->qb->update()
            ->table('users');
        
        foreach($data as $d)
        {
            $query->set($d[0], $d[1], $d[2]);
        }

        $res = $query
            ->where('username', $user, 's')    
            ->commit();
        return $res; 

        

    }

    public function searchUsers(String $username)
    {
        $res = $this->qb->select('u.username, i.url')
        ->from('users u')
        ->join('images i', 'i.id', 'u.image')
        ->where('username', 'LIKE', '%' . $username . '%', 's')
        ->commit();

        if(count($res) == 0)
            return [];
        
        return $res;
    }

    public function checkIfUserVote($post)
    {
        $res = $this->qb->select('*')
            ->from('votes')
            ->where('voter', '=', $_SESSION['user']->getUsername(), 's')
            ->where('post', '=', $post, 'i')
            ->commit();

        if(count($res) == 0)
            return false;
        return true;
    }

    public function insertVote($post)
    {
        $this->nc->makePostNotification($_SESSION['user']->getUsername(), $post);
        return $this->qb->insert('post, voter')
            ->into('votes')
            ->value($post, 'i')
            ->value($_SESSION['user']->getUsername(), 's')
            ->commit();
    }

    public function removeVote($post)
    {
        $this->nc->removePostNotification($_SESSION['user']->getUsername(), $post);
        return $this->qb->delete()
            ->table('votes')
            ->where('post', $post, 'i')
            ->andWhere('voter', $_SESSION['user']->getUsername(), 's')
            ->commit();
    }

    public function unfollow($follower, $followed)
    {
        $this->qb->delete()
            ->table('follows')
            ->where('follower', $follower, 's')
            ->andWhere('followed', $followed, 's')
            ->commit();
            return $this->nc->removeFollowNotification($followed, $follower);
    }

    public function follow($follower, $followed)
    {
        $this->qb->insert('follower, followed')
            ->into('follows')
            ->value($follower, 's')
            ->value($followed, 's')
            ->commit();
            return $this->nc->makeNotification($followed, $follower, NULL, NULL);
    }
}
