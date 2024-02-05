<?php

require_once("utils/functions.php");
require_once("utils/bootstrap.php");

require('vmc/Controllers/NotificationController.php');

use vmc\Controllers\NotificationController;

if(isset($_POST['notification']))
{
    $noti = $_POST['notification'];

    $nc = new NotificationController($dbh);

    $nc->removeNotification($noti);
}



?>