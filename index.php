<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");
require_once("vmc/Controllers/PostController.php");
require_once("vmc/Controllers/DiscussionController.php");

use vmc\Controllers\UserController;
use vmc\Controllers\PostController;
use vmc\Controllers\DiscussionController;

if(isUserLoggedIn())
{
    if(isset($_GET['my_profile']))
    {
        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['user'] = $_SESSION['user'];
    }
    elseif(isset($_GET['post']))
    {
        $pc = new PostController($dbh);
        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/post-list.php";
        $templateParams['posts'] = $pc->selectPosts();
    }
    elseif(isset($_GET['discussion_post']))
    {
        $dc = new DiscussionController($dbh);
        $templateParams['discussions'] = $dc->getAllDiscussionsFromPost($_GET['discussion_post']);
        $templateParams['title'] = "Commenti";
        $templateParams['content'] = "vmc/Views/discussion.php";


        /* $pc = new PostController($dbh);
        $templateParams['content'] = "vmc/Views/post-list.php";
        $templateParams['posts'] = $pc->selectPosts(); */
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
