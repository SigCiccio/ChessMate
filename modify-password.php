<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

if(isUserLoggedIn())
{
    $uc = new UserController($dbh);
    $username = $_SESSION['user']->getUsername();


    if($uc->checkPassword($username, $_POST['old-password']) && $_POST['new-password'] != "" && isEqual($_POST['new-password'], $_POST['conf-password']))
    {
        if(isEqual($_POST['old-password'], $_POST['new-password']))
            header("Location: index.php?modify-password&error&old-new");
        else
        {
            var_dump(isEqual($_POST['old-password'], $_POST['new-password']));
        
            $uc->updatePassword($username, $_POST['new-password']);
            header("Location: index.php?my_profile");
        }
        
    }
    else 
        header("Location: index.php?modify-password&error");


    
}
else 
    header("Location: index.php");