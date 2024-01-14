<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php"); 
require_once("vmc/Controllers/PostController.php");

use vmc\Controllers\UserController; 
use vmc\Controllers\PostController;

if(isUserLoggedIn())
{
    if(isset($_GET['my_profile']))
    {
        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['user'] = $_SESSION['user'];
    }
    else if(isset($_GET['view-post-game']))
    {
        $pc = new PostController($dbh);
        
        $templateParams['title'] = "Partita";
        $templateParams['content'] = "vmc/Views/view-game.php";
        $templateParams['script'] = '<script src="js/chessboard.js"></script>';
        $templateParams['post'] = $pc->selectPostById($_GET['view-post-game']);
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css">';
    }
    else 
    {
        $pc = new PostController($dbh);
        $templateParams['title'] = "Home";
        $templateParams['content'] = "vmc/Views/view-posts.php";
    }
}
else
{
    $templateParams['no-nav'] = true;
    $templateParams['script'] = '<script src="js/log-sign.js"></script>';
    $templateParams['title'] = "Login";
    $templateParams['content'] = "vmc/Views/log-sign.php";
}

require_once("base.php");
