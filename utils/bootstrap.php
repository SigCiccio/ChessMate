<?php

session_start();

require_once("utils/functions.php");
require_once("utils/DatabaseHelper.php");

$dbh = new DatabaseHelper("localhost", "root", "", "chessmate", 3306);
