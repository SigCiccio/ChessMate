<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

if(isUserLoggedIn())
{
    if(isset($_GET['my_profile']))
    {
        $templateParams['title'] = "Il Mio Profilo";
        $templateParams['content'] = "vmc/Views/view-profile.php";
        $templateParams['user'] = $_SESSION['user'];
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
