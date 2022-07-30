<?php 
include_once 'Bank.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    
    $errors = [];
    if(empty($name) || empty($email)){
        echo "<div class='alert alert-danger'>Please fill all fields </div>";
        $errors[] = "Empty input";
    }

    if(strlen($name) < 3){
        echo "<div class='alert alert-danger'>Name should  be longer that 2</div>";
        $errors[] = "Invalid name";
    }

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<div class='alert alert-danger'>Invalid email address</div>";
    $errors[] = "Invalid email";
}

if(empty($errors)){
   $result = subscribers($name, $email);
   echo $result;
   
}


}