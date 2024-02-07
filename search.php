<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

header("Content-Type: application/json");

if(isUserLoggedIn())
{
    if(isset($_GET['username']))
    {
        $uc = new UserController($dbh);
        $um = $uc->searchUsers($_GET['username']); 
        echo json_encode($um);
    }
}

