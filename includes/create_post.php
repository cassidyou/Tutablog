<?php 
require_once 'blog-config.php';
require_once 'includes/Bank.php';



// Getting form data
if(isset($_POST['submit'])){
   $title = cleanInput($_POST['title']);
   $post_body = htmlspecialchars($_POST['post_content']);
   $category_id = cleanInput($_POST['category_id']);
   $author = cleanInput($_POST['author_id']);
   $watermark = cleanInput($_POST['watermark']);
   $date = date('Y-m-d H:i:s');
   $slug = slugify($title);



  //Form validation
  $image = $_FILES['image'];
if ($_FILES['image']['size'] === 0){
   $errors[] = 'No image selected, please chose post image.';
  }elseif($image && $image['tmp_name']){
  $imagePath = '';


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

    
  };

  // Check if input fields are empty
   if(!$title){
    $errors[] = 'Please enter the post title';
}

  if(!$post_body){
    $errors[] = 'Please enter post content';
}

  if(!$category_id){
    $errors[] = 'Please select post category';
}

  if(!$author){
    $errors[] = 'Please select post author';
}


   if(empty($errors)){
    
    //move the image to the uploads directory
     $imagePath = 'uploads/post'.randomName(8).$image['name'];
        move_uploaded_file($image['tmp_name'], $imagePath);

      //Fetch the watermark image from the watermark table
      $stmt = $conn->prepare("SELECT * FROM watermark");
      $stmt->execute();
      $watermarks = $stmt->fetchAll(PDO::FETCH_ASSOC);

      //watermark image
      $watermark_image = $watermarks[0]['image'];


      //Do not add insert watermark image to the post if the user selected no for watermark
        if($watermark == 0){
          $stmt = $conn->prepare("INSERT INTO posts (user_id, title, slug, image, body, published, created_at)
                              VALUES(?, ?, ?, ?, ?, ?, ?);");

        $stmt->execute([$author, $title, $slug, basename($imagePath), $post_body, 0, $date]);

        //Insert watermark image to the post if the user selected yes for watermark
        }elseif($watermark == 1){

          $stmt = $conn->prepare("INSERT INTO posts (user_id, title, slug, image, body, watermark, published, created_at)
                              VALUES(?, ?, ?, ?, ?, ?, ?, ?);");

        $stmt->execute([$author, $title, $slug, basename($imagePath), $post_body, $watermark_image, 0, $date]);
        }

        



    //    //Getting the last inserted post_id
        $post_id = $conn->lastInsertId();

        //Inserting this post to it's category table
        $sql = $conn->prepare("INSERT INTO post_category (post_id, category_id) VALUES (?, ?);");
        $sql->execute([$post_id, $category_id]);



    $post_id = $conn->lastInsertId();

      $source_id = $_SESSION['id'];
        $post_title = $title;
        $title = "Created a post";
        $message = "Submitted a post titled <b><i>".strtoupper($post_title)."</i></b> for review and publishing.";
        
        
        //Fetching the data of All the Admins
        $sql = $conn->prepare("SELECT id FROM users WHERE role = ?");
        $sql->execute(["Admin"]);
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($results as $admin_id){
          $stmt = $conn->prepare("INSERT INTO notification (destination_id, source_id, post_id, title, message) 
                                VALUES (?, ?, ?, ?, ?)");
          $stmt->execute([$admin_id['id'], $source_id, $post_id, $title, $message]);  
        }
        





     //redirect to create page
     header("location: ./admin-create-post.php?msg");
   }

 
  

}



