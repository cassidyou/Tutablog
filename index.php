<?php 
require_once './blog-config.php';
require_once 'includes/Bank.php';


$categories = getCategory();
$allposts = getAllPosts();
// print_r($allposts);

if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}

$limit = 8;
$start_from = ($page - 1) * $limit;
$posts = getPublishedPosts($start_from, $limit);

$stmt = $conn->prepare("SELECT * FROM posts WHERE published = ?");
$stmt->execute(['1']);
$number_of_results = $stmt->rowCount();
$number_of_pages = ceil($number_of_results / $limit);

?>

<?php require_once 'includes/header.php' ?>

    <title>TutaBlog - Home</title>
</head>
<body>

<!--header-->
<header name="slide" id="slide-img">
<?php require_once 'includes/navbar.php' ?>
<div id="titleHint"></div>
    <!--showcase section-->
    <div  class="showcase">
        <div class="showcase-content">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="showcase-text">
                    <h1 >A Traveller's <br>  Story</h1>
                </div>
                <h5 class="text-light">
                  Lorem ipsum dolor sit amet. Lorem ipsum dolor sit  amet consectetur adipisicing <br>
                   elit. Earum, dolorum.  Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet  <br>
                  consectetur adipisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor

                </h5>
                <div class="showcase-btn">
                  <br>
                    <a href="#sticky">Discover More</a>
                </div>
            </div>
        </div>
    </div>

<style>
.watermark{
  position: absolute;
  z-index: 9999;
  height: 50px;
  width: 150px;
  top: 150px;
  right: 0;
}

.watermark img{
  height: 150px;
}
</style>
   
</header>





<main>
  <!--Carousel section-->
   <?php include_once 'includes/carousel.php' ?>


  <!----------------------------------------- Blog Posts ------------------------------------------------>
  <div class="container">
    <div class="row" id="blog">
      <div class="blog-post col-lg-9">
        <div class="row ">

          <?php foreach($posts as $post): ?>

            <?php 
            $excerpt = substr($post['body'], 0, 230)."...";
            $id = $post['id'];
            $category_id = $post['category_id'];
            $date = date('M d, Y ', strtotime($post['created_at']));
            $title = $post['title'];
            $slug = $post['slug'];
            $image = $post['image'];
            $watermark = $post['watermark'];
            ?>
            <div class="col-md-6 mb-5">
              <div class="post-content">
                <?php 
                  if(isset($watermark)){
                          echo "<span class='watermark'><img src=uploads/".$watermark."></span>";
                        }
                ?>
                <div class="post-img">
                    <?php 
                      echo "<a href=single-post.php?slug=".$slug."&id=".$category_id."><img src=uploads/".$image."></a>";
                    ?>
                  
                  <!-- <h5 class="post-category">Fashion</h5> -->
                </div>
                <div class="post-date"><?php echo  $date ?> </div>
                <div class="post-title">
                  <h3 class="text-primary"><a href=single-post.php?slug=<?php echo $slug ?>&id=<?php echo $category_id ?>><?php echo $title ?></a> </h3>
                </div>
                <p class="excerpt">  <?php echo $excerpt ?> </p>
                <div class="readmore text-right">
                  <a href=single-post.php?slug=<?php echo $slug ?>&id=<?php echo $category_id ?> class="read-more-btn">Read more &nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>

          <?php endforeach ?>
        </div>

        <div class="row text-center my-5">
          <div class="col-12">
            <?php 
              // if(isset($_GET['page']) && $_GET['page'] > 1){
              //   echo "<a href='index.php?page=".($page - 1)."'>Prev </a>";
              // } 
             
              if($page > 1){
                echo "<a href='index.php?page=".($page - 1)."'> Prev</a>";
              }
              
           
                // for($page; $page <= $number_of_pages; $page++){
                  // if(isset($_GET['page']) && $_GET['page'] == $page){
                    echo "<span class='bg-secondary rounded text-light py-1 px-3 mx-2'> ".$page." </span>";
                  // }
                  // else{
                  //   echo "<a href='index.php?page=".$page."' class='bg-primary rounded text-light py-1 px-2 mx-2'> ".$page." </a>";
                  // }
                 
                // }
           
              // if(isset($_GET['page']) && $_GET['page'] != $number_of_pages){
              //   echo "<a href='index.php?page=".($page + 1)."'> Next</a>";
              // } 
              if($page < $number_of_pages){
                echo "<a href='index.php?page=".($page + 1)."'> Next</a>";
              }
            ?>
          </div>
        </div>
         
      </div>

          <!------------------------------------------------ Side Bar ------------------------------------------------------------>
          <?php include_once 'includes/sidebar.php' ?>
    </div>
</div>
</main>


<?php include_once 'includes/footer.php' ?>



