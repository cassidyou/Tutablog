<?php include_once 'admin/header.php' ?>
<?php 


$successMsg = '';
$title = '';
$post_body = '';
$category = '';
$author = '';
$image = '';

if(isset($_GET['msg'])){
    $successMsg = $_GET['msg']; 
     $successMsg = 'Your post is successfully submitted';
      header("Refresh:3; ./admin-create-post.php");
}



include_once 'includes/create_post.php';

$users = getAllusers();
$categories = getCategory();



?>

<style>
    
.err{
    color: red;
    font-size: 1rem;
}
.smgs{
    font-size: 1.5rem;
}
</style>


<title>Create Post</title>
<?php include_once 'admin/navbar.php' ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-12 main-lay py-3 px-5">
                        <span class="text-success fs-2 smgs"><?php echo $successMsg ?></span>

                        <h4 class="my-4 mb-5">Create Post</h4>
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                       <div class="row">
                        <div class="col-12">
                            <form action="" method="POST" enctype="multipart/form-data">

                                
                                    <div>
                                        <h6 class="text-secondary"><b>Post Image</b></h6>
                                        <input type="file" name="image" value="<?php echo $image ?>" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary"><b>Post Title</b></h6>
                                        <input type="text" name="title" value="<?php echo $title ?>" placeholder="Enter post title" class="form-control">
                                        
                                    </div>
                               
                               
                                <h6 class="text-secondary mt-5"><b>Post Content/Description</b></h6>
                                <textarea name="post_content"cols="30" rows="20" class="form-control mb-5"><?php echo $post_body ?></textarea>
                               

                               
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <h6 class="text-secondary"><b>Category</b></h6>
                                        <select name="category_id" class="form-control">
                                            <option value="">Choose....</option>
                                            <?php foreach($categories as $category) :?>
                                                    <option value="<?php echo $category['id']?>"><?php echo $category['category_name']?></option>
                                                <?php endforeach?>
                                            
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <h6 class="text-secondary"><b>Author</b></h6>
                                        <select name="author_id" class="form-control">
                                            <option value="">Choose...</option>
                                                <?php foreach($users as $user) :?>
                                                    <option value="<?php echo $user['id']?>"><?php echo $user['first_name']?></option>
                                                <?php endforeach?>
                                        </select>
                                       
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-12">
                                        <label for="watermark"><b>Do you want to add watermark image?</b></label>
                                        <br>
                                        <input type="radio" name="watermark" value="1" checked> Yes
                                        <br>
                                        <input type="radio" name="watermark" value="0"> No
                                    </div>
                                </div>


                                <div class="text-center">
                                    <input type="submit" name="submit" id="disable" onclick="return confirm('You are about to submit a post?');" value="Submit Post" class="btn btn-success mt-4 submit">
                                </div>

                               
                               
                               
                                
                            </form>

                        </div>
                       </div>

                      
                       </div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>

