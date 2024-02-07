<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");
require_once("vmc/Controllers/ImageController.php");

use vmc\Controllers\UserController;
use vmc\Controllers\ImageController;

if(isUserLoggedIn())
{
    $user = $_SESSION['user'];
    $data = [];

    if(!isset($_FILE['image'])){
        header("Location: index.php?modify-profile&error");
    }

    if(isset($_FILES['image']) && $_FILE['image'] != NULL){
        $ic = new ImageController($dbh);
        $user->setImage($ic->newImage($_FILES['image']));
        $data[] = ['image', $user->getImage()->getId(), 'i'];
    } 

    if($_POST['mail'] != $user->getMail())
    {
        echo $_POST['mail'];
        $data[] = ['mail', $_POST['mail'], 's'];
        $user->setMail($_POST['mail']);
    }
    if($_POST['username'] != $user->getUsername())
    {
        $data[] = ['username', $_POST['username'], 's'];
        $user->setUsername($_POST['username']);
    }
    if($_POST['name'] != $user->getName())
    {
        $data[] = ['name', $_POST['name'], 's'];
        $user->setName($_POST['name']);
    }
    if($_POST['surname'] != $user->getSurname())
    {
        $data[] = ['surname', $_POST['surname'], 's']; 
        $user->setSurname($_POST['surname']);
    }
    if($_POST['bio'] != $user->getBio())
    {
        $data[] = ['bio', $_POST['bio'], 's'];
        $user->setBio($_POST['bio']);
    }


    if(count($data) == 0)
        header("Location: index.php?my_profile&no-change");
    else
    {
        $uc = new UserController($dbh);
        $uc->updateUser($data, $user->getUsername());
        header("Location: index.php?my_profile&changes");
    }  
}
else 
    header("Location: index.php");