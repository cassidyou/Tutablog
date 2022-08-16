<?php


if(isset($_POST['submit'])){
    $username = cleanInput($_POST['username']);
    $password = cleanInput($_POST['password']);

    $errors = [];

    if(!$username){
        $errors[] = "Please enter your username";
    }
    if(!$password){
        $errors[] = "Please enter your password";
    }

    if(empty($errors)){
        
        getUser($username, $password);
    }
}