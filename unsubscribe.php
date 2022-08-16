<?php 

include_once 'includes/Bank.php';


$emailErr = '';
if(isset($_POST['submit'])){
    $email = cleanInput($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        header("Location: unsubscribe.php?emailErr");
        exit();
      }else{
        unsubscribe($email);
      }

    


}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/all.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Unsubscribe</title>
    </head>
    
    <body>
    <div class="container">
            
            <div class="row my-5">
                <div class="col-12 col-md-3 col-lg-3"></div>
                <div class="col-12 col-md-6 col-lg-6">
                    <?php if(isset($_GET['success'])){  ?>
                        <div class="row mt-5 text-center align-items-center justify-content-center">
                             <h5 class="text-success my-5">You have been successfully unsubscribed from our newsletter.</span>
                            <br> 
                            <div class="mt-5">
                                <a href="index.php" class="btn btn-primary">Click here to continue</a>
                            </div>

                        </div>
                    <?php }elseif(isset($_GET['notEmail'])) { ?>
                        <div class="row mt-5 text-center align-items-center justify-content-center">
                             <h5 class=" my-5">The email you supplied is not subscribed to our newsletter.</span>
                            <br> 
                            <div class="mt-5">
                                <a href="unsubscribe.php" class="btn btn-danger mx-2">Unsubscribe</a>
                                <a href="index.php" class="btn btn-primary text-center mx-2">I'd rather stay</a>
                                
                            </div>

                        </div>
                       
                    <?php   } elseif(isset($_GET['emailErr'])){  ?>
                        <form method="post" >
                        <img src="assets/img/unsubscribe_img.gif" class="img-fluid w-75">
                        <h4 class="text-primary">Are you sure about unsubscribing from our newsletter?</h4>
                        <br>
                        <h5>
                            If you unsubscribe now, you might miss educating and entertaining posts from Tutablog
                        </h5>
                    
                        <br>
                        <input type="text" name="email" placeholder="Enter your email" class="form-control">
                     
                        <span class="text-left text-danger">
                            <?php if(isset($_GET['emailErr'])){echo 'Please enter a valid email'; } ?>
                        </span>
                        <br><br>
                        

                        <div class="text-center">
                        <a href="index.php" class="btn btn-primary text-center mx-2">I'd rather stay</a>
                        <input type="submit" name="submit" value="Unsubscribe" class="btn btn-danger mx-2 text-center">

                        </div>

                    </form>
                    <?php    } else {  ?>
                        <form method="post" >
                        <img src="assets/img/unsubscribe_img.gif" class="img-fluid w-75">
                        <h4 class="text-primary">Are you sure about unsubscribing from our newsletter?</h4>
                        <br>
                        <h5>
                            If you unsubscribe now, you might miss educating and entertaining posts from Tutablog
                        </h5>
                    
                        <br>
                        <input type="text" name="email" placeholder="Enter your email" class="form-control">
                     
                        <span class="text-left text-danger">
                        </span>
                        <br><br>
                        

                        <div class="text-center">
                        <a href="index.php" class="btn btn-primary text-center mx-2">I'd rather stay</a>
                        <input type="submit" name="submit" value="Unsubscribe" class="btn btn-danger mx-2 text-center">

                        </div>

                    </form>
                    <?php    } ?>
                    
                    
                </div>
                <div class="col-12 col-md-3 col-lg-3"></div>

            </div>
        </div>

    </body>
</html>
  

