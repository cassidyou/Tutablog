<?php

include_once 'Bank.php';

// Getting form data
if(isset($_POST['submit'])){
   $first_name = cleanInput($_POST['firstname']);
   $last_name = cleanInput($_POST['lastname']);
   $user_name = cleanInput($_POST['username']);
   $email = cleanInput($_POST['email']);
   $new_password = cleanInput($_POST['new_password']);
   $confirm_password = cleanInput($_POST['confirm_password']);
   $current_password = cleanInput($_POST['password']);
   $date = date('Y-m-d H:i:s');
   

  

   
   $user = getUserById($_SESSION['id']);
   $user_current_password =  $user['password'];

   $user_id = $user['id'];
   
  
   $errors = [];

   $image = $_FILES['image'];
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

    if(strlen($new_password) > 0 && strlen($new_password) < 8){
       $errors[] = 'password length can not be less than 8 characters';
    }

    
    if($new_password != $confirm_password){
        $errors[] = "Password mismatch";
    }

    // Check if current password is in the database
    $user_password =  $user['password'];
    $check_pwd = password_verify($current_password, $user_current_password);

    if(empty($errors) && $check_pwd == true){
       

            // $imagePath = 'uploads/'.randomName(8).$image['name'];
            // // mkdir(dirname($imagePath));
            //     move_uploaded_file($image['tmp_name'], $imagePath);
    

            if(empty($new_password) && $_FILES["image"]["size"] == 0){

                $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?,
                 updated_at = ? WHERE id = ?");

                $stmt->execute([$first_name, $last_name, $user_name, $email, $date, $user_id]);

                header("Location: user-setting.php?success");
                exit();
            }elseif($_FILES["image"]["size"] !== 0 && empty($new_password)){
                 $imagePath = 'uploads/user'.randomName(8).$image['name'];
    
                move_uploaded_file($image['tmp_name'], $imagePath);

                $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, image = ?,
                 updated_at = ? WHERE id = ?");

                $stmt->execute([$first_name, $last_name, $user_name, $email, basename($imagePath), $date, $user_id]);

                header("Location: user-setting.php?success");
                exit();

            }elseif($_FILES["image"]["size"] == 0 && !empty($new_password)){
                $hashed_pwd = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, password = ?,
                 updated_at = ? WHERE id = ?");

                $stmt->execute([$first_name, $last_name, $user_name, $email, $hashed_pwd, $date, $user_id]);

                header("Location: user-setting.php?success");
                exit();
            }elseif($_FILES["image"]["size"] !== 0 && !empty($new_password)){

                 $imagePath = 'uploads/'.randomName(8).$image['name'];
            // mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);

                $hashed_pwd = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?, password = ?,
                image = ?, updated_at = ? WHERE id = ?");

                $stmt->execute([$first_name, $last_name, $user_name, $email, $hashed_pwd, $imagePath, $date, $user_id]);

                header("Location: user-setting.php?success");
                exit();
            }
    }
}


//Activating a user
if(isset($_GET['activate'])){
   $user_id = $_GET['activate'];
    
   $stmt = $conn->prepare("UPDATE users SET active = ? WHERE id = ?;");
   $stmt->execute(['1', $user_id]);
   
   header("location: ../users.php");
}

//Deactivating a user
if(isset($_GET['deactivate'])){
    $user_id = $_GET['deactivate'];
    $stmt = $conn->prepare("UPDATE users SET active = ? WHERE id = ?;");
   $stmt->execute(['0', $user_id]);

   header("location: ../users.php");

}

