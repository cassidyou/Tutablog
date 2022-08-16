<?php include_once 'admin/header.php' ?>

<?php 
$error = '';
$message = '';



    




if (isset($_POST['submit'])){

    $errors = [];
    $date = date("Y-m-d H:i:s"); 

    $watermark_image = $_FILES['watermark'];
    if ($watermark_image['size'] === 0){

       $errors[] = 'No watermark image selected, please chose watermark image.';

    }elseif($watermark_image && $watermark_image['tmp_name']){
        
        $imagePath = '';
      $imageFileType = strtolower(pathinfo($watermark_image["name"],PATHINFO_EXTENSION));
      
      //Check if file is an image
      $check = getimagesize($watermark_image["tmp_name"]);
      if (!$check) {
        $errors[] = "The file you selected is not allowed.";
      }

      // Check file size
      if ($watermark_image["size"] > 100000) {
        $errors[] = "Sorry, your file is too large.";
     
      }

        // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
      }


      if(empty($errors)){
        
        $imagePath = 'uploads/watermark-'.randomName(6).$watermark_image['name'];
         
            if(move_uploaded_file($watermark_image['tmp_name'], $imagePath)){
                
          
               
                $stmt = $conn->prepare("UPDATE watermark SET image = ?, updated_at = ?;");
                $stmt->execute([basename($imagePath), $date]);
                
                header("Location: admin-create-watermark.php?success");
            }
            

      }

    
    }

   
   
}

// $stmt = $conn->prepare("SELECT * FROM watermark");
// $stmt->execute();
// $watermarks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<img src=uploads/".$watermarks[0]['image'].">"


?>


<title>Update Watermark Image</title>
<?php include_once 'admin/navbar.php' ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-12 main-lay py-3 px-5">
                            <h4 class="my-4 mb-5">Create Category</h4>
                            <div class="row">
                                <div class="col-12">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                                <?php 
                                                    if(isset($_GET['success'])){
                                                        $message = $_GET['success'];
                                                        $message = "Watermark is successfully updated";
                                                        echo '<span class="alert alert-success my-2">'.$message .'</span>';
                                                    }

                                                   
                                                    if(!empty($errors)){
                                                        foreach($errors as $error){
                                                        echo "<div class='text-danger'>$error</div>";
                                                        }
                                                    }
                                                    
                                                ?>
                                            <div class="my-5">
                                                   
                                               
                                                <h6 class="text-secondary"><b>Upload watermark image</b></h6>
                                                <input type="file" name="watermark"  class="form-control">
                                            </div>
                                        <div class="text-center">
                                            <input type="submit" name="submit"  onclick="return confirm('You are about to update the blog watermark image?');" value="Update watermark" class="btn btn-success mt-4 submit">
                                        </div>
                                    </form>
                                </div>
                            </div>         
                       </div>
                    </div>
                  </div>

<?php include_once 'admin/footer.php' ?>

