<?php 
require_once 'blog-config.php';
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
        $imagePath = 'uploads/post'.randomName(8).$image['name'];
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




   if(empty($errors)){
        $stmt = $conn->prepare("UPDATE posts SET title = ?, slug = ?, image = ?, body = ?, updated_at = ? WHERE id = ?");
        $stmt->execute([$title, $slug, basename($imagePath), $post_body, $date, $post_id]);

        $posts = getSinglePost($_GET['slug']);
        $source_id = $_SESSION['id'];
        $post_title = $posts['0']['title'];
        $title = "Updated a post";
        $message = "Updated a post titled <b><i>".strtoupper($post_title)."</i></b>";
        
        
        //Fetching the data of All the Admins
        $sql = $conn->prepare("SELECT id FROM users WHERE role = ?");
        $sql->execute(["Admin"]);
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($results as $admin_id){
          $stmt = $conn->prepare("INSERT INTO notification (destination_id, source_id, post_id, title, message) 
                                VALUES (?, ?, ?, ?, ?)");
          $stmt->execute([$admin_id['id'], $source_id, $post_id, $title, $message ]);  
        }
        
       
    


    //  redirect to create page
     header("location: ./admin-manage-post.php?updated");
   }
  

}

