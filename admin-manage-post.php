<?php include_once 'admin/header.php' ?>
<?php 
//Admin fucntionalities
$posts = getAllPosts();

//Authors functionalities
$usersposts = getAllUserPosts($_SESSION['id']);
?>
<title>Manage Post</title>
<?php include_once 'admin/navbar.php' ?>

<style>
  .btn-publish1{
    cursor: default;
    pointer-events: none;        
    text-decoration: none;
    color: grey;
    background-color: #aaaaaa;
    border-color:#aaaaaa;
    }
</style>

                  <h5 class="page-title my-4">Posts</h5>
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                      <?php
                          if(isset($_GET['updated']) ){
                            $message = $_GET['updated'];
                            $message = "Your post was successfully updated!";
                            echo "<div class='alert alert-success my-3'> $message </div>";
                          }
                          if(isset($_GET['success']) ){
                            $message = $_GET['success'];
                            $message = "Your post was successfully published and notification sent to subscribers!";
                            echo "<div class='alert alert-success my-3'> $message </div>";
                          }
                          if(isset($_GET['partial']) ){
                            $message = $_GET['partial'];
                            $message = "Your post was successfully published!";
                            $Errmsg = "Sorry, something went wrong, notification was not sent to subscribers!";
                            echo "<div class='alert alert-success my-3'> $message </div>";
                            echo "<div class='alert alert-danger my-3'> $Errmsg </div>";
                          }
                          if(isset($_GET['deleted']) ){
                            $message = $_GET['deleted'];
                            $message = "Your post was successfully deleted!";
                            echo "<div class='alert alert-success my-3'> $message</div>";
                          }
                        ?>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-12 main-lay py-3">
                        
                      
                        <h4>Posts</h4>

                        <?php if(isset($_SESSION['role'])) : ?>
                          <?php if(($_SESSION['role']) == "Admin"){  ?>
                            <div class="table-container">
                              <table class="table .table-hover">
                                  <thead class="bg-secondary text-light">
                                    <tr>
                                      <th scope="col">Id</th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Title</th>
                                      <th scope="col">Author</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  <?php foreach($posts as $post) : ?>
                                    <?php 
                                      $title = $post['title'];
                                      $id = $post['id'];
                                      $slug = $post['slug'];
                                      $publish = isPublished($id);
                                      $publish = strval($publish);
                                      $author_firstname = $post['author_firstname'];
                                      $author_lastname = $post['author_lastname'];
                                      $category = $post['category_name'];
                                      
                                    ?>

                                    
                                    <tr>
                                      <th scope="row"><?php echo $id ?></th>
                                      <td><?php echo "<img src=uploads/".$post['image']." style='height: 50px;'>"?></td>
                                      <td><p><?php echo $title?></p></td>
                                      <td><p><?php echo $author_firstname. " ". $author_lastname; ?></p></td>
                                      <td><?php echo $category ?></td>
                                      
                                      <td><div class="action">
                                          <a href="admin-update-post.php?slug=<?php echo $slug ?>" class="btn btn-primary">Update</a>
                                          <a href="./includes/publish.php?slug=<?php echo $slug ?>" onclick="return confirm('You are about to publish this post?');" class="btn btn-success btn-publish<?php echo $publish ?>">Publish</a>
                                          <a href="./includes/delete.php?slug=<?php echo $slug ?>" onclick="return confirm('You are about to delete this post?');" class="btn btn-danger">Delete</a>
                                          <h1 id="status"> </h1>
                                      </div></td>
                                    </tr>

                                    <script>
                                    
                                    </script>

                                  <?php endforeach ?>
                                  

                                    
                                  
                                  </tbody>
                                </table>
                            </div>

                          <?php }else{  ?>
                            <div class="table-container">
                              <table class="table .table-hover">
                                  <thead class="bg-secondary text-light">
                                    <tr>
                                      <th scope="col">Id</th>
                                      <th scope="col">Image</th>
                                      <th scope="col">Title</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Action</th>
                                      <th scope="col">Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  <?php foreach($usersposts as $userspost) : ?>
                                    <?php 
                                      $title = $userspost['title'];
                                      $id = $userspost['id'];
                                      $slug = $userspost['slug'];
                                      $publish = isPublished($id);
                                      $publish = strval($publish);
                                      $category = $userspost['category_name'];
                                      
                                    ?>

                                    
                                    <tr>
                                      <th scope="row"><?php echo $id ?></th>
                                      <td><?php echo "<img src=uploads/".$userspost['image']." style='height: 100px'>" ?></td>
                                      <td><p><?php echo $title?></p></td>
                                      <td><?php echo $category ?></td>
                                      
                                      <td><div class="action">
                                          <a href="admin-update-post.php?slug=<?php echo $slug ?>" class="btn btn-primary">Update</a>
                                          
                                          <a href="./includes/delete.php?slug=<?php echo $slug ?>" onclick="return confirm('You are about to delete this post?');" class="btn btn-danger">Delete</a>
                                          <h1 id="status"> </h1>
                                      </div></td>
                                       <td>
                                      <p>
                                      <span class="btn btn-success btn-publish<?php echo $publish ?>">Publish</span>
                                      </p>
                                    </td>
                                    </tr>
                                   

                                 

                                  <?php endforeach ?>
                                  

                                    
                                  
                                  </tbody>
                                </table>
                            </div>

                          <?php } ?>
                        <?php endif  ?>
                       

                      


                       </div>
                      </div>
                  </div>

                 

<?php include_once 'admin/footer.php' ?>
<script>
 $(document).ready(function(){
  $("span.btn-publish1").text("Published").css({
    "background-color":"green",
    "border-color":"green",
    "color":"white"
  })
  $("span.btn-publish0").text("Pending").css({
    "background-color":"gray",
    "border-color":"gray",
    "color":"white",
    "cursor": "default"
  })
 })
</script>