<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require_once("vmc/Controllers/UserController.php");

use vmc\Controllers\UserController;

if(isUserLoggedIn())
{

}
else
{
    $templateParams['no-nav'] = true;
    $templateParams['script'] = '<script src="js/log-sign.js"></script>';
    $templateParams['title'] = "Login";
    $templateParams['content'] = "vmc/Views/log-sign.php";
}

require("base.php");
