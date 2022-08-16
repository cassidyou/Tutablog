<?php 

include_once 'includes/Bank.php';

if(isset($_POST['submit'])){
    $email = cleanInput($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: forgot-password.php?emailErr");
       
      }else{
        forgotPassword($email);
       
      }
    
    
}


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
    <title>Forgot Password</title>

    <style>
        .form-control:focus{
            outline: none!important;
            border-color: rgba(0,0,0,0.2);
            box-shadow: none;
        }
    </style>
    </head>
    
<body>
 <div class="container">
    
    <div class="row text-center my-5">
        <div class="col-12 col-md-3 col-lg-3"></div>
        <div class="col-12 col-md-6 col-lg-6" id="admin-login">

        <h3 class="text-center mt-2 mb-4">Forgot Password</h3>
               
               <?php 
                if(isset($_GET['success'])){
                    echo "<div class='alert alert-warning'>
                    If your account exists, you'll receive instruction on how to reset your password on your email.
                    </div>";
                }
                if(isset($_GET['emailErr'])){
                    echo "<div class='alert alert-danger'>Please enter a valid email address</div>";
                }
                if(isset($_GET['error'])){
                    echo "<div class='alert alert-danger'>Ops! Something went wrong, please try again later</div>";
                }
               
               ?>
            
            <form action="" method="post" class="text-left">
             
                <label for="username"><b>Enter your email address</b> </label>
                <input type="text" name="email" placeholder="Enter  email" class="form-control">
                <br>

                <div class="text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary text-center">
                    
                </div>

            </form>
        </div>
        <div class="col-12 col-md-3 col-lg-3"></div>

    </div>
 </div>



 
    <!--Fontawesome js-->
    <script src="assets/js/all.min.js"></script>

    <!--jQuery js-->
    <script src="assets/js/jQuery3.6.0.min.js"></script>

    <!--Boostrap 4 js-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!--Owl carousel js-->
    <script src="assets/js/owl.carousel.min.js"></script>

     <!--AOS Library-->
     <script src="assets/js/aos.js"></script>

    <!--custom js-->
    <script src="assets/js/main.js"></script>
</body>
</html>
  

