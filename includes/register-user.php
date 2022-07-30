<?php

require_once 'includes/PHPMailer.php'; 
require_once 'includes/SMTP.php'; 
require_once 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once 'Bank.php';

// Getting form data
if(isset($_POST['submit'])){
   $first_name = cleanInput($_POST['firstname']);
   $last_name = cleanInput($_POST['lastname']);
   $user_name = cleanInput($_POST['username']);
   $email = cleanInput($_POST['email']);
   $gender = cleanInput($_POST['gender']);
   $role = cleanInput($_POST['role']);
   $password = cleanInput($_POST['password']);
   $password_repeat = cleanInput($_POST['confirm_password']);
   $date = date('Y-m-d H:i:s');


   $errors = [];
  


   //Form validation
    if ($_FILES['image']['size'] === 0){
        $errors[] = 'No image selected, please chose post image.';
    }else{
        $image = $_FILES['image'] ?? null;

        $imagePath = '';
    if ($image && $image['tmp_name']){


      $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
      
      
      //Check if file is an image
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if (!$check) {
        $errors[] = "The file you selected is not allowed.";
      }

      // Check file size
      if ($_FILES["image"]["size"] > 100000) {
        $errors[] = "Sorry, your file is too large.";
     
      }

        // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
      }

    }
  };

//   Check if input fields are empty
   if(!$first_name){
        $errors[] = 'Please enter users firstname';
    }

  if(!$last_name){
        $errors[] = 'Please enter users lastname';
    }

  if(!$user_name){
        $errors[] = 'Please enter users username';
    }
    if(!preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
        $errors[] = "Invalid username. Username should only contain alphabets and numbers.";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email address";
    }

  if(!$gender){
        $errors[] = 'Please select users gender';
    }

  if(!$role){
        $errors[] = 'Please select users role';
    }

  if(!$password){
        $errors[] = 'Please enter users password';
    }

    if(strlen($password) < 8){
         $errors[] = "Password lenght is too short";
    }
    if($password != $password_repeat){
        $errors[] = "Password mismatch";
    }

  if(!$password_repeat){
        $errors[] = 'Password does not match';
    }



   if(empty($errors)){
    
      // Check if user exists
      $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
      $stmt->execute([$user_name, $email]);

      // if user exists
    if($stmt->rowCount() == 1){
        $errors[] = "username or email already exists";
      }

      if($stmt->rowCount() == 0 && empty($errors) == true){
          $imagePath = 'uploads/'.randomName(8).'/'.$image['name'];
          mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);

          //Hashing the password
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          $stmt = $conn->prepare("INSERT INTO users (
                                                  first_name,
                                                  last_name,
                                                  username,
                                                  email,
                                                  role,
                                                  password,
                                                  image,
                                                  created_at
                                                      ) 
                                              VALUES (?, ?, ?, ?, ?, ?, ?, ?);"
                                  );
          $stmt->execute([
              $first_name,
              $last_name,
              $user_name,
              $email,
              $role,
              $hashedPwd,
              $imagePath,
              $date
          ]);

          // Forward user login details to the registered email
          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->Host = "smtp-relay.sendinblue.com";
          $mail->SMTPAuth = "true";
          $mail->SMTPSecure = "tls";
          $mail->Port = "587";
          $mail->Username = "oluchi.web@gmail.com";
          $mail->Password = "QXG1rF58LZqjs7pB";

          $mail->isHTML(true);
          $mail->Subject = "Registration on tutablog";
          $mail->setFrom("oluchi.web@gmail.com", "Tutablog");
          $mail->Body = " <p> Hi <b> $first_name $last_name!</b></p>
                        
                        Your registration on tablog was successful. Please find your login details below: <br>
                        <b>Username is: </b> $user_name <br>
                        <b>Password is: </b> $password <br>
                        <b>Role is: </b> $role <br> 

                        <p>Please login below </p>
                        <p><a href='http://localhost/tutablog/user-login.php'> Login </a> </p>
                        
                        
                      <b>Best Regards </b> <br>
                        Oluchi Cassidy for tutablog";
          $mail->addAddress($email);
        
          if( $mail->send()){
           
          }else{
            exit();
            header("Location: ./admin-register-user.php?partial");


          }
          $mail->smtpClose();
          

            header("Location: ./admin-register-user.php?success");

      }
    
  }
 

}

