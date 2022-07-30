<?php 
require_once './blog-config.php';
require_once 'includes/Bank.php';

$posts = getPublishedPosts();
$categories = getCategory();
$allposts = getAllPosts();

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
            ?>
            <div class="col-md-6 mb-5">
              <div class="post-content">
                <div class="post-img">
                  <a href=single-post.php?slug=<?php echo $slug ?>&id=<?php echo $category_id ?>><img src="<?php echo $image ?>"></a>
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

         
      </div>

          <!------------------------------------------------ Side Bar ------------------------------------------------------------>
          <?php include_once 'includes/sidebar.php' ?>
    </div>
</div>
</main>


<?php include_once 'includes/footer.php' ?>



