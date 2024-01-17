<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

if(isUserLoggedIn())
{
    $uc = new UserController($dbh);
    $followed = $_GET['username'];
    $follower = $_SESSION['user']->getUsername();



    if($_GET['action'] == 'unfollow')
    {

        $found = NULL;

        foreach($_SESSION['user']->getFollowList() as $f)
        {
            if($f == $followed)
            {
                $found = $f;
                break;
            }
        }
        if($found != NULL)
        {
            $_SESSION['user']->removeToFollow($followed);
            $_SESSION['user']->setFollowNumber($_SESSION['user']->getFollow() - 1);
            $uc->unfollow($follower, $followed);
            $data = ['res' => 'success'];
        }
        else 
        {
            $data = ['res' => $followed . ' not found'];
        }
    }
    else 
    {
        $_SESSION['user']->setFollowNumber($_SESSION['user']->getFollow() + 1);
        $_SESSION['user']->addToFollow($followed);
        $uc->follow($follower, $followed);   
        $data = ['res' => 'success']; 
    }

    echo json_encode($data);
}

