<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php"); 
require_once("vmc/Controllers/PostController.php");
require_once("vmc/Controllers/CommentController.php");

use vmc\Controllers\UserController; 
use vmc\Controllers\PostController;
use vmc\Controllers\CommentController;

if(isUserLoggedIn())
{
    if(isset($_GET['my_profile']))
    {
        $pc = new PostController($dbh);

        $templateParams['user'] = $_SESSION['user'];
        $templateParams['posts'] = $pc->selectPostsByAuthor($templateParams['user']->getUsername());

        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['script'] = '<script src="js/post-preview.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css">';
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
    else if(isset($_GET['view-profile']))
    {
        $uc = new UserController($dbh);
        $pc = new PostController($dbh);

        $templateParams['user'] = $uc->selectUserFromUsername($_GET['view-profile']);
        $templateParams['posts'] = $pc->selectPostsByAuthor($templateParams['user']->getUsername());

        $templateParams['title'] = $templateParams['user']->getUsername();
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['script'] = '<script src="js/post-preview.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css">';
    }
    else if(isset($_GET['modify-profile']))
    {
        $templateParams['title'] = 'Modifica Profilo';
        
        $templateParams['content'] = "vmc/Views/modify-profile.php";
    }
    else if(isset($_GET['view-post-comment']))
    {
        $cc = new CommentController($dbh);

        $templateParams['comments'] = $cc->selectCommentsOfPost($_GET['view-post-comment']);

        $templateParams['title'] = 'Commenti';
        $templateParams['content'] = "vmc/Views/view-comment.php";
    }
    else if(isset($_GET['upload-game']))
    {
        $templateParams['title'] = "Nuovo post";
        $templateParams['content'] = "vmc/Views/upload-post.php";
    }
    else 
    {
        $pc = new PostController($dbh);
        
        $templateParams['posts'] = $pc->getMostRecentPost();
        $templateParams['script'] = '<script src="js/post-preview.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css">';
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
