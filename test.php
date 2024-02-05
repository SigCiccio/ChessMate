<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/CommentController.php");

use vmc\Controllers\CommentController;

if(isUserLoggedIn())
{
    
    $cc = new CommentController($dbh);

    $publication_date = date('Y-m-d');
    $publication_time = date('H:i:s');
    $commentId = $cc->insertComment(2, 'hikaru', $publication_date, $publication_time, 'Nuovo commento');
    $res = $cc->selectCommentById($commentId);
}
else 
    header("Location: index.php");
