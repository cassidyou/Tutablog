<?php include_once 'admin/header.php' ?>
<?php 

$successMsg = '';
$title = '';
$post_body = '';
$category = '';
$author = '';
$image = '';

if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
    $posts = getSinglePost($slug);
    
}

$errors = [];

include_once './includes/update-post.php';


$users = getAllusers();
$categories = getCategory();

?>
<?php include_once "admin/navbar.php" ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-12 main-lay py-3 px-5">
                        <h4 class="my-4 mb-5">Update Post</h4>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                       <div class="row">
                        <div class="col-12">
                            <form action="" method="POSt" enctype="multipart/form-data">
                                <?php 
                                if(isset($_GET['slug'])) : ?>
                                    <?php  
                                     $slug = $_GET['slug'];
                                    $posts = getSinglePost($slug);
                                    ?>
                                    <?php foreach($posts as $post) : ?>
                                        <?php 
                                            $title = $post['title'];
                                            $id = $post['id'];
                                            $content = $post['body'];
                                            $image = $post['image'];


                                        ?>
                                        
                                        <div>
                                        <h6 class="text-secondary">Current Post Image</h6>
                                            <img src="<?php echo $image ?>" class="img-fluid w-25 my-4" alt="image">
                                            <h6 class="text-secondary">Post Image</h6>
                                            <input type="file" name="image"  class="form-control">
                                        </div>
                                        <div class="my-5">
                                            <h6 class="text-secondary"> Post title</h6>
                                            <input type="text" name="title" value="<?php echo $title?>" class="form-control">
                                        </div>
                                
                                
                                    <h6 class="text-secondary mt-5">Post content/Description</h6>
                                    <textarea name="post_content"cols="30" rows="20" class="form-control mb-5"><?php echo $content?></textarea>

                                    <input type="text" name="post_id" value="<?php echo $id ?>" class="text-white border-0">
                                    <input type="text" name="prev_img" value="<?php echo $image ?>" class="text-white border-0">
                                <?php endforeach ?>

                                <div class="text-center">
                                    <input type="submit" name="submit" onclick="return confirm('You are about to update this post?');" value="Save Update" class="btn btn-success mt-4">
                                </div>

                                <?php endif ?>

                              


                               

                               

                               
                               
                               
                                
                            </form>

                        </div>
                       </div>

                      
                       </div>
                      </div>
                  </div>
<?php include_once "admin/footer.php" ?>



                 