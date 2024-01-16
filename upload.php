<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/PostController.php");

use vmc\Controllers\PostController;

if(isUserLoggedIn())
{
    if(!isset($_POST['title']) || !isset($_POST['game']))
    {
        header("Location: index.php?upload-game&error");    
    }
    $pc = new PostController($dbh);

    $data = [
        'title' => $_POST['title'],
        'author' => $_SESSION['user']->getUsername(),
        'game' => $_POST['game'],
        'publication_date' => date('Y-m-d'),
        'publication_time' => date('H:i:s'),    
    ];
    $id = $pc->uploadPost($data);

    header("Location: index.php?view-post-game=" . $id );
    


}
else 
    header("Location: index.php");