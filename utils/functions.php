<?php

require_once('vmc/Models/UserModel.php');

function logUser($user){
    $_SESSION["user"] = $user;    
}

function isUserLoggedIn(){

    return !empty($_SESSION["user"]);

}

function logoutUser(){
    $_SESSION["user"] = NULL;
}

function isEqual($s1, $s2)
{
    return $s1 == $s2;
}