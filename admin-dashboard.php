<?php include_once 'admin/header.php' ?>

<?php 
//Admin functionalities
$posts = getAllPosts();
$postsTotal = getPostRows();
$categoryTotal = getCategoriesRows();
$blogViews = getAllViews();
$blogcomments = getAllComments();
$topPosts = popularPosts(10);

$IP = getIPAddress();







//Authors functionalities
$usersposts = getAllUserPosts($_SESSION['id']);
$usersTotalPost = userTotalPosts($_SESSION['id']);
$usersTotalViews = userTotalviews($_SESSION['id']);
$usersTotalComments = usersTotalComment($_SESSION['id']);
?>


<title>Home - Admin</title>
<?php include_once 'admin/navbar.php';  ?>



                
                  <h5 class="page-title my-4">Dashboard</h5>
                  <?php if(isset($_SESSION['role'])) : ?>
                    <?php if($_SESSION['role'] == "Admin"){ ?>
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-sticky-note fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Posts</h5>
                                    <h3><?php echo $postsTotal; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-user fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Views</h5>
                                    <h3><?php echo $blogViews ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box">
                            <div class="media">
                                <div class="icon"><span class="fa fa-th-list fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Categories</h5>
                                    <h3><?php echo $categoryTotal ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-comment fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Comments</h5>
                                    <h3><?php echo $blogcomments ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  </div>

                  <div class="container-fluid">
                    <div class="row">

                    
                        <div class="col-12 main-lay py-3" style="overflow-x: scroll;">
                            <h4>Top 10 Popular Posts</h4>

                            <table class="table">
                                <thead class="bg-secondary text-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($topPosts as $topPost): ?>
                                        <?php 
                                            $title = $topPost['title'];
                                            $id = $topPost['id'];
                                            $category_name = $topPost['category_name'];
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $id ?></th>
                                        <td><?php echo "<img src=uploads/".$topPost['image']." style='height: 100px'>" ?></td>
                                        <td><h5><?php echo $title ?></h5></td>
                                        <td><h6><?php echo $category_name ?></h6></td>
                                    
                                    </tr>
                                    <?php endforeach ?>
                                
                                </tbody>
                            </table>
                       </div>
                    <?php }else{ ?>
                        <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-sticky-note fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Posts</h5>
                                    <h3><?php echo $usersTotalPost; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-user fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Views</h5>
                                    <h3><?php echo $usersTotalViews ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card-box">
                            <div class="media d-flex">
                                <div class="icon"><span class="fa fa-comment fa-2x text-secondary"></span></div>
                                <div class="content">
                                    <h5 class="text-primary">Comments</h5>
                                    <h3><?php echo $usersTotalComments ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                        <div class="col-12 main-lay py-3" style="overflow-x: scroll;">
                            <h4>Your Posts</h4>

                            <table class="table">
                                <thead class="bg-secondary text-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($usersposts as $userspost): ?>
                                        <?php 
                                            $title = $userspost['title'];
                                            $id = $userspost['id'];
                                            $category_name = $userspost['category_name'];
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $id ?></th>
                                        <td><?php echo "<img src=uploads/".$userspost['image']." style='height: 100px;'>" ?></td>
                                        <td><h5><?php echo $title ?></h5></td>
                                        <td><h6><?php echo $category_name ?></h6></td>
                                    
                                    </tr>
                                    <?php endforeach ?>
                                
                                </tbody>
                            </table>
                       </div>
                    <?php } ?>
    
                <?php endif ?>
                       


                      </div>
                  </div>


<?php include_once 'admin/footer.php' ?>
<script>
    var a = geoplugin_countryCode();
    

    var country = geoplugin_countryName();
    // alert(country);
</script>