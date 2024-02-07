<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/PostController.php");

use vmc\Controllers\PostController;

if(isUserLoggedIn())
{
    if(isset($_GET['post']))
    {
        $pc = new PostController($dbh);

        $pc->deletePost($_GET['post']);
    }

    header("Location: index.php?my_profile");
    


}
else 
    header("Location: index.php");