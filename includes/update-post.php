<?php 
require_once 'includes/Bank.php';





// Getting form data
if(isset($_POST['submit'])){
   $title = cleanInput($_POST['title']);
   $post_body = htmlspecialchars($_POST['post_content']);
   $post_id = cleanInput($_POST['post_id']);
//    $category_id = cleanInput($_POST['category_id']);
//    $author = cleanInput($_POST['author_id']);
//    $watermark = cleanInput($_POST['watermark']);
   $date = date('Y-m-d H:i:s');
   $slug = slugify($title);

   


  //Form validation
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
      if(empty($errors)){
        $imagePath = 'uploads/'.randomName(8).'/'.$image['name'];
        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);
      }

    }else{
        $imagePath = $_POST['prev_img'];
    }
  

// Check if input fields are empty
   if(!$title){
    $errors[] = 'Please enter the post title';
   }

  if(!$post_body){
    $errors[] = 'Please enter post content';
    }

//   if(!$category_id){
//     $errors[] = 'Please select post category';
//     }

//   if(!$author){
//     $errors[] = 'Please select post author';
//     }


   if(empty($errors)){
     


        $stmt = $conn->prepare("UPDATE posts 
                                SET title = ?,
                                    slug = ?, 
                                    image = ?, 
                                    body = ?, 
                                    updated_at = ?
                                WHERE id = ?");

        $stmt->execute([$title, $slug, $imagePath, $post_body, $date, $post_id]);


    //  redirect to create page
     header("location: ./admin-manage-post.php?updated");
   }
  

}

