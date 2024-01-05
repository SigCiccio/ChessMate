<?php 

require_once("vmc/Controllers/ImageController.php");
require_once('utils/functions.php');
require_once('utils/bootstrap.php');

use vmc\Controllers\ImageController;

if (isset($_POST['submit']) && isset($_FILES['my_image'])) 
{
    $ic = new ImageController($dbh);
    $ic->newImage($_FILES['my_image']);
}
else 
{
	header("Location: index.php");
}