<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php"); 
require_once("vmc/Controllers/NotificationController.php");
require_once("vmc/Controllers/PostController.php");
require_once("vmc/Controllers/CommentController.php");

require_once("vmc/Models/UserModel.php"); 

use vmc\Controllers\UserController; 
use vmc\Controllers\NotificationController; 
use vmc\Controllers\PostController;
use vmc\Controllers\CommentController;

use vmc\Models\UserModel; 

if(isUserLoggedIn())
{
    $nc = new NotificationController($dbh);

    if(isset($_GET['my_profile']))
    {
        $pc = new PostController($dbh);
        $uc = new UserController($dbh);

        $templateParams['user'] = $_SESSION['user'];
        $templateParams['posts'] = $pc->selectPostsByAuthor($templateParams['user']->getUsername());

        $templateParams['upvote'] = [];
        foreach($templateParams['posts'] as $p)
        {
            $templateParams['upvote'][] = [
                'post' =>  $p->getId() ,
                'upvote' => $uc->checkIfUserVote($p->getId())
            ];
        }

        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['script'] = '<script src="js/post-preview.js"></script><script src="js/vote.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css"><link rel="stylesheet" href="css/home.css"><link rel="stylesheet" href="css/profile.css">';
    }
    else if(isset($_GET['view-post-game']))
    {
        $pc = new PostController($dbh);
        
        $templateParams['title'] = "Partita";
        $templateParams['content'] = "vmc/Views/view-game.php";
        $templateParams['script'] = '<script src="js/pieces.js"></script><script src="js/chessboard.js"></script>';
        $templateParams['post'] = $pc->selectPostById($_GET['view-post-game']);
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css"><link rel="stylesheet" href="css/game.css">';
    }
    else if(isset($_GET['view-profile']))
    {
        if($_GET['view-profile'] == $_SESSION['user']->getUsername())
            header("Location: index.php?my_profile");

        $uc = new UserController($dbh);
        $pc = new PostController($dbh);

        $templateParams['user'] = $uc->selectUserFromUsername($_GET['view-profile']);
        $templateParams['posts'] = $pc->selectPostsByAuthor($templateParams['user']->getUsername());

        $templateParams['is-followed'] = false;

        $templateParams['upvote'] = [];
        foreach($templateParams['posts'] as $p)
        {
            $templateParams['upvote'][] = [
                'post' =>  $p->getId() ,
                'upvote' => $uc->checkIfUserVote($p->getId())
            ];
        }

        $templateParams['title'] = $templateParams['user']->getUsername();
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['script'] = '<script src="js/post-preview.js"></script><script src="js/follow-unfollow.js"></script><script src="js/vote.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css"><link rel="stylesheet" href="css/home.css"><link rel="stylesheet" href="css/profile.css">';
    }
    else if(isset($_GET['notifications']))
    {
        $templateParams['notifications'] = $nc->getNotifications($_SESSION['user']->getUsername()); 
        foreach($templateParams['notifications'] as $noti)
            $nc->notificationViewed($noti->getId());

        $templateParams['comment-controller'] = new CommentController($dbh);
        $templateParams['title'] = 'Notifiche';
        $templateParams['script'] = '<script src="js/notifications.js"></script>';
        $templateParams['content'] = "vmc/Views/view-notifications.php";
        $templateParams['style'] = '<link rel="stylesheet" href="css/notifications.css">';
    }
    else if(isset($_GET['modify-profile']))
    {
        $templateParams['title'] = 'Modifica Profilo';
        
        $templateParams['content'] = "vmc/Views/modify-profile.php";
        $templateParams['style'] = '<link rel="stylesheet" href="css/modify-profile.css">';
    }
    else if(isset($_GET['view-post-comment']))
    {
        $cc = new CommentController($dbh);

        $templateParams['comments'] = $cc->selectCommentsOfPost($_GET['view-post-comment']);

        $templateParams['title'] = 'Commenti';
        $templateParams['script'] = '<script src="js/comment.js"></script>';
        $templateParams['content'] = "vmc/Views/view-comment.php";
        $templateParams['style'] = '<link rel="stylesheet" href="css/comments.css">';
    }
    else if(isset($_GET['upload-game']))
    {
        $templateParams['title'] = "Nuovo post";
        $templateParams['content'] = "vmc/Views/upload-post.php";
        $templateParams['style'] = '<link rel="stylesheet" href="css/add-game.css">';
    }
    else if(isset($_GET['search-user']))
    {
        $templateParams['title'] = "Nuovo post";
        $templateParams['script'] = '<script src="js/search.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/search.css">';
        $templateParams['content'] = "vmc/Views/search-user.php";
    }
    else if(isset($_GET['follow']))
    {
        $uc = new UserController($dbh);
        
        $templateParams['user'] = $uc->selectUserFromUsername($_GET['follow']);
        $templateParams['users-list'] = $templateParams['user']->getFollowList();
        $templateParams['title'] = "Follow";
        $templateParams['style'] = '<link rel="stylesheet" href="css/search.css">';
        $templateParams['content'] = "vmc/Views/followers-follow.php";
    }
    else if(isset($_GET['followers']))
    {
        $uc = new UserController($dbh);
        
        $templateParams['user'] = $uc->selectUserFromUsername($_GET['followers']);
        $templateParams['users-list'] = $templateParams['user']->getFollowersList();
        $templateParams['style'] = '<link rel="stylesheet" href="css/search.css">';
        $templateParams['title'] = "Followers";
        $templateParams['content'] = "vmc/Views/followers-follow.php";
    }
    else if(isset($_GET['modify-password']))
    {
        $templateParams['title'] = 'Modifica Profilo';
        
        $templateParams['content'] = "vmc/Views/modify-password.php";
        $templateParams['style'] = '<link rel="stylesheet" href="css/modify-profile.css">';
    }
    else 
    {
        $uc = new UserController($dbh);
        $pc = new PostController($dbh);
        
        $templateParams['posts'] = $pc->getMostRecentPost();
        $templateParams['upvote'] = [];
        foreach($templateParams['posts'] as $p)
        {
            $templateParams['upvote'][] = [
                'post' =>  $p->getId() ,
                'upvote' => $uc->checkIfUserVote($p->getId())
            ];
        }
        $templateParams['script'] = '<script src="js/vote.js"></script><script src="js/post-preview.js"></script>';
        $templateParams['style'] = '<link rel="stylesheet" href="css/chessboard.css"><link rel="stylesheet" href="css/home.css">';
        $templateParams['title'] = "Home";
        $templateParams['content'] = "vmc/Views/view-posts.php";
    }

    $templateParams['notification-count'] = count($nc->getUnviewedNotification($_SESSION['user']->getUsername()));
}
else
{
    $templateParams['no-nav'] = true;
    $templateParams['script'] = '<script src="js/log-sign.js"></script>';
    $templateParams['style'] = '<link rel="stylesheet" href="css/login.css">';
    $templateParams['title'] = "Login";
    $templateParams['content'] = "vmc/Views/log-sign.php";
}

require_once("base.php");
