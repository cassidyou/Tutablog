<?php 
require_once 'includes/PHPMailer.php'; 
require_once 'includes/SMTP.php'; 
require_once 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$email = '';
if(isset($_GET['email'])){
$email = $_GET['email'];

}



?>
<?php 

include_once 'includes/Bank.php';

if(isset($_POST['submit'])){
    $password = cleanInput($_POST['password']);
    $confirm_password = cleanInput($_POST['confirm_password']);
    
    $errors = [];
    
    if(!$password){
        $errors[] = 'Please create a new password';
    }

    if(strlen($password) < 8){
         $errors[] = "Password length is too short. 8 characters atleast.";
    }
    if($password != $confirm_password){
        $errors[] = "Password mismatch";
    }

  if(!$confirm_password){
        $errors[] = 'Please enter confirm password';
    }

   $errLength = count($errors);
   
   $hash_password = password_hash($password, PASSWORD_DEFAULT);
   
   

   if($errLength === 0){
        global $conn;
        $sql = $conn->prepare("SELECT * FROM users  WHERE email = ?;");
        $sql->execute([$email]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!$user){
            header("location: reset-password.php?notfound");
            exit();
        }

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?;");
        $stmt->execute([$hash_password, $email]);


        // Forward reset password details to the registered email
        $mail = new PHPMailer(true);
        //  $mail->SMTPDebug = 2; 
        $mail->isSMTP();
        $mail->Host = "smtp-relay.sendinblue.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "oluchi.web@gmail.com";
        $mail->Password = "xsmtpsib-4b851c7c225da14d3f6a257eade2adbc8deb42d61bab6091ee98f70e86f5d1a7-26NPVbLKwQsZq0Rk";
        
        $mail->isHTML(true);
        $mail->Subject = "TutaBlog: Password Reset";
        $mail->setFrom("okorondukwe@outlook.com", "Tutablog");
        $mail->Body = " <p> Hi <b>".$user['first_name']."!</b></p>
                    
                    You have successfully changed your password. Please find your new login details below: <br>
                    <b>Username is: </b> ".$user['username']." <br>
                    <b>Password is: </b> ".$password." <br>
                    
                    <p>Please click on the link below to login</p>
                    <p><a href='http://localhost/tutablog/user-login.php'> Login </a> </p>
                    
                    
                    <b>Best Regards </b> <br>
                    Oluchi Cassidy for tutablog";
        $mail->addAddress($email);
    
     if( $mail->send()){
         header("location: reset-password.php?sent");
     }else{
         header("location: reset-password.php?notsent");
     }
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
    <title>Reset Password</title>

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


        <?php if(isset($_GET['sent'])){ ?>

        <?php
            
            echo "<div class='text-success my-5'>Check your email for your new login details or 
            click on the link below to login </div> 
            <a href='http://localhost/tutablog/user-login.php' class='btn btn-success'>Login</a>"; 
            
        ?>
        <?php }elseif(isset($_GET['notsent'])){ ?>
            <?php
            
                echo "<div class='alert alert-success'>You have successfully changed your password</div> 
                    <div class='alert alert-danger'>Ops! Something went wrong your login details could not be delivered
                    to your email. </div>
                    <div class='text-secondary my-5'>Please proceed to login, by clicking on the link below </div>
                    <a href='http://localhost/tutablog/user-login.php' class='btn btn-success'>Login</a>"; 
            
             ?>

        <?php }elseif(isset($_GET['notfound'])){ ?>
            <?php
            
                echo "
                    <div class='alert alert-danger'>Ops! Something went wrong, please try again later. </div>

                    <div class='text-secondary my-5'>Please proceed to login, by clicking on the link below </div>
                    <a href='http://localhost/tutablog/user-login.php' class='btn btn-success'>Login</a>"; 
            
             ?>

        <?php }else{ ?>
            <h3 class="text-center mt-2 mb-4">Reset Password</h3>
               
        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger text-left">
                            <?php foreach($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
            
            <form action="" method="post" class="text-left">
                <div class="text-success mb-3">Your account email is: &nbsp; <?php echo $email ?></div>
             
                <label for="password">Create a new password</label>
                <input type="password" name="password" placeholder="Enter a new password" class="form-control">
                <br>
                <label for="password">Confirm password</label>
                <input type="password" name="confirm_password" placeholder="Confirm password" class="form-control">
                <br>

                <div class="text-center">
                <input type="submit" name="submit" value="Reset Password" class="btn btn-primary text-center">
                    
                </div>

            </form>
        </div>
       <?php }?>

    
        
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
  

