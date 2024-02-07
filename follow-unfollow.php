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
        $data['followed'] = $followed;
        $data['follower'] = $follower;
        $data['remove-to-follow'] = $_SESSION['user']->removeToFollow($followed);
        if($data != -1)
        {
            $data['unfollow'] = true;
            $uc->unfollow($follower, $followed);
        }
    }
    else 
    {
        $_SESSION['user']->addToFollow($followed);
        $data = $uc->follow($follower, $followed);
    }

    echo json_encode($data);
}

