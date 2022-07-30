<?php 

include_once 'includes/Bank.php';
include_once 'includes/login.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
    </head>
    
<body>
 <div class="container">
    
    <div class="row text-center my-5">
        <div class="col-12 col-md-3 col-lg-4"></div>
        <div class="col-12 col-md-6 col-lg-4" id="admin-login">

        <h3 class="text-center mt-2 mb-4">User Login</h3>
                <?php if(isset($_GET['notfound'])){
                            $errMsg = $_GET['notfound'];
                            $errMsg = "Incorrect username or email";
                            echo "<div class='alert alert-danger'> $errMsg </div>";
                        }
                     if(isset($_GET['wrongp'])){
                            $errMsg = $_GET['wrongp'];
                            $errMsg = "Incorrect password";
                            echo "<div class='alert alert-danger '> $errMsg </div>";
                        }
                     if(isset($_GET['login'])){
                            $errMsg = $_GET['login'];
                            $errMsg = "Access Denied: You must be logged in to visit that page";
                            echo "<div class='alert alert-danger '> $errMsg </div>";
                        }
                        ?>
                <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
               
            
            <form action="" method="post" class="text-left" id="admin-logi">
             
                <label for="username"><b>Username</b> </label>
                <input type="text" name="username" placeholder="Enter username or email" class="form-control">
                <br>
                <label for="username"><b>Password</b></label>
                <input type="password" name="password" placeholder="Enter password" class="form-control">
                <br>

                <div class="text-center">
                <input type="submit" name="submit" value="Login" class="btn btn-primary text-center">

                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 col-lg-4"></div>

    </div>
 </div>
  

