<?php $carouselPosts = popularPosts(8); ?>

<div class="carousel-container">
      <div class="owl-carousel owl-theme">

        <?php foreach($carouselPosts as $post) :?>
          <div class="carousel-content">
            <div class="carousel-img-container" >
            <a href=single-post.php?slug=<?php echo $post['slug'] ?>&id=<?php echo $post['category_id'] ?>>
            <?php echo "<img src=uploads/".$post['image']." class='img-fluid img-carousel'>" ?>
              
            </a>
            </div>
            <div class="carousel-title">
              <h5 class="title">
                <a href=single-post.php?slug=<?php echo $post['slug'] ?>&id=<?php echo $post['category_id'] ?>>
                  <?php echo $post['title'] ?>
                </a>
              </h5>
              <h6 class="text-secondary">By <?php echo $post['first_name']. " "; echo $post['last_name']  ?></h6>
            </div>
        </div>
        <?php endforeach ?>
            
      

      </div>
    </div>