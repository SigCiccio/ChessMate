<?php


function logUser($user){
    $_SESSION["user"] = $user;    
}

function isUserLoggedIn(){

    return !empty($_SESSION["user"]);

}

function logoutUser(){
    $_SESSION["user"] = NULL;
}

?>