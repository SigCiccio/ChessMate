<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

if(!isUserLoggedIn())
{
    $uc = new UserController($dbh);

    if(isset($_POST['sign']))
    {
        $um = $uc->selectUserFromMail($_POST['new-mail']);
        if($um['res'] != -1)
            header("Location: index.php?sign-error=mail");
        else 
        {
            $um = $uc->selectUserFromUsername($_POST['username']);
            if(!isset($um['res']) || $um['res'] != [])
                header("Location: index.php?sign-error=username");
            else 
            {
                if($_POST['new-password'] != "" && $_POST['name'] != "" && $_POST['surname'] != "" && $_POST['birthday'] != "")
                {
                    $data = [
                        'mail'          => $_POST['new-mail'],
                        'password'      => $_POST['new-password'],
                        'username'      => $_POST['username'],
                        'name'          => $_POST['name'],
                        'surname'       => $_POST['surname'],
                        'birthday'       => $_POST['birthday'],
                    ];
                    $uc->insertNewUser($data);

                    $um = $uc->selectUserFromMail($_POST['new-mail']);
                    logUser($um['value']);
                    header("Location: index.php?my_profile");
                }
                else    
                    echo "error";
            }
        }

    } 
    else 
    {
        $um = $uc->selectUserFromMail($_POST['mail']);

        if(!isset($um['res']) || $um['res'] == -1)
            header("Location: index.php?error=mail");
        else 
        {
            $checkPassword = $uc->checkPassword($um['value']->getUsername(), $_POST['password']);
            if($checkPassword)
            {
                logUser($um['value']);
                header("Location: index.php?my_profile");
            }
            else
            {
                header("Location: index.php?error=password");
            }
        }
    }
    
}
else 
{
    logoutUser();
    header("Location: index.php");
}