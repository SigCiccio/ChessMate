<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

header("Content-Type: application/json");

if(isUserLoggedIn())
{
    $uc = new UserController($dbh);
    if(isset($_POST['action']))
    {
        if(json_decode($_POST['action'] == 'remove'))
        {
            echo json_encode(['vote-id' => $uc->removeVote($_POST['post'])]);
            return 0;
        }
        else 
        {
            echo json_encode(['vote-id' => $uc->insertVote($_POST['post'])]);
            return 0;
        }
        
    }
}

