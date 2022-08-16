<?php require_once './blog-config.php';
require_once 'includes/Bank.php';

$category_id = $_GET['id'];
$posts = getPostByCategory($category_id); 

?>


<?php require_once 'includes/header.php' ?>


    <title>Fashion</title>

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
</head>
<body>

<!--header-->
<?php require_once 'includes/navbar.php' ?>
<div id="titleHint"></div>
<main>
  <!--Carousel section-->
  

   <?php include_once 'includes/carousel.php' ?>


  <!----------------------------------------- Fashion ------------------------------------------------>
  <div class="container">
    <div class="row" id="blog">
        
      <div class="blog-post col-lg-9">
        

        
          <div class="direction mb-4">
          <a href="index.php">Home</a> > <?php echo $posts[0]['category_name'] ?>
        </div>
        
        <h3 class="heading"><?php echo $posts[0]['category_name']?></h3>
       
      <div class="row ">
        <?php foreach($posts as $post) : ?>
          <?php 
          $excerpt = substr($post['body'], 0, 230)."...";
          $id = $post['id'];
          $date = date('M d, Y ', strtotime($post['created_at']));
          $title = $post['title'];
          $slug = $post['slug'];
          $watermark = $post['watermark'];
          $image = $post['image'];
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
              <h3 class="text-primary"><a href="single-post.php?id=<?php echo $post['category_id']?>&slug=<?php echo $slug ?>"><?php echo $title ?></a> </h3>
            </div>
            <p class="excerpt">  <?php echo $excerpt ?> </p>
            <div class="readmore text-right">
              <a href="single-post.php?id=<?php echo $post['category_id']?>&slug=<?php echo $slug ?>" class="read-more-btn">Read more &nbsp;<i class="fas fa-chevron-right"></i></a>
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




<?php require_once 'includes/footer.php' ?>