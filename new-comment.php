<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/CommentController.php");

use vmc\Controllers\CommentController;

if(isUserLoggedIn())
{
    $cc = new CommentController($dbh);
    
    if(isset($_GET['remove']))
    {
        $cc->deleteComment($_POST['comment']);
    } 
    else 
    {
        $publication_date = date('Y-m-d');
        $publication_time = date('H:i:s');
        $commentId = $cc->insertComment($_POST['post-id'], $_POST['user'], $publication_date, $publication_time, $_POST['new-comment']);
        $res = $cc->selectCommentById($commentId);
        echo json_encode($res); 
    }   
}
else 
    header("Location: index.php");
