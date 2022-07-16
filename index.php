<?php require_once './blog-config.php';
require_once 'includes/Bank.php';

$posts = getPublishedPosts();


?>

<?php require_once 'includes/header.php' ?>

    <title>TutaBlog - Home</title>
</head>
<body>

<!--header-->
<header name="slide" id="slide-img">
<?php require_once 'includes/navbar.php' ?>

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
        <!-- <h3 class="heading">Fashion</h3> -->
        <div class="post-row">
          <div class="post-content">
            <div class="post-img">
              <a href="post.html"><img src="assets/img/fashion-girl2.jpg"></a>
              <h5 class="post-category">Fashion</h5>
            </div>
            <div class="post-date">
            By Brad Traversy, July 5, 2022
                </div>
            <div class="post-title">
              <h3 class="text-primary"><a href="post.html">Style Tips Every Woman Should Know</a> </h3>
            </div>
            <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
            fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
          <div class="readmore text-right">
            <a href="post.html" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
          </div>

          </div>

          <div class="post-content">
            <div class="post-img">
              <a href=""><img src="assets/img/fashion-boy2.jpg" alt="post1-image"></a>
              <h5 class="post-category">Fashion</h5>
            </div>
            <div class="post-date">
            By John Doe, July 5, 2022
                </div>
            <div class="post-title">
              <h3 class="text-primary">The Trend of Men's Clothing</h3>
            </div>
            <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
            fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
          <div class="readmore text-right">
            <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
          </div>
          </div>
        </div>


        <br><br><br>

          <div class="post-row">
            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/asun-nigerian.webp"></a>
                <h5 class="post-category">Food</h5>
              </div>
              <div class="post-date">
              By Edon Muffy, May 5, 2021
                  </div>
              <div class="post-title">
                <h3 class="text-primary"><a href="">The Most Popular Fast Food Chains</a> </h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>

            </div>

            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/boli+and+fish.webp" alt="post1-image"></a>
                <h5 class="post-category">Food</h5>
              </div>
              <div class="post-date">
              By Tardy James, April 9, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary">London Most sort after Delicacy 2022</h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
          </div>


          <br><br><br>
          
       
          
       
          <div class="post-row">
            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/tech.jpg"></a>
                <h5 class="post-category">Tech</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary"><a href="">Everything You can Imagine is Real</a> </h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>

            </div>

            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/tech2.jpg" alt="post1-image"></a>
                <h5 class="post-category">Tech</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary">Use the Right Gaming Gear and Settings</h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
          </div>

          <br><br><br>
          
          
          <div class="post-row">
            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/sports.jpg"></a>
                <h5 class="post-category">Sports</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary"><a href=""> The Most Watched Sports in the World</a> </h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>

            </div>

            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/sports2.jpg" alt="post1-image"></a>
                <h5 class="post-category">Sports</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary">Why You should be Watching Basketball</h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
          </div>

          <br><br><br>
          
          <div class="post-row">
            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/lifestyle.jpg"></a>
                <h5 class="post-category">Lifestyle</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary"><a href="">Reasons why girls are mostly happy</a> </h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>

            </div>

            <div class="post-content">
              <div class="post-img">
                <a href=""><img src="assets/img/travel.jpg" alt="post1-image"></a>
                <h5 class="post-category">Lifestyle</h5>
              </div>
              <div class="post-date">
              By John Doe, July 5, 2022
                  </div>
              <div class="post-title">
                <h3 class="text-primary">A traveller's story</h3>
              </div>
              <p class="excerpt">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, architecto consectetur est eum exercitationem modi quae
              fugiat eius quaerat sit illo perspiciatis sequi, in itaque? Beatae molestiae magni possimus distinctio...</p>
            <div class="readmore text-right">
              <a href="" class="read-more-btn">read more &nbsp;<i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
          </div>


          <!------------------------------------------------ Side Bar ------------------------------------------------------------>
        </div>
        
        <aside class="sidebar col-lg-3"> 

          <form action="" class="search-form">
            <div class="input-group mb-3">
              <input type="text" name="keyword" class="form-control search-input" placeholder="Enter keyword">
              <div class="input-group-append">
                <input type="submit" value="Search" class="input-group-text input-btn search-btn">
              </div>
            </div>
          </form>
          <hr>


          <div id="sidebar">
            <div class="content">
              <h3 class="heading sidebar-heading">Categories</h3>
              <ul class="ml-3" id="categories">
                <li><a href="">Food</a></li>
                <li><a href="">Fashion</a></li>
                <li><a href="">Technology</a></li>
                <li><a href="">Sports</a></li>
                <li><a href="">Education</a></li>
              </ul>
            </div>
            
            <div id="latest-post" class="content my-5">
              <h3 class="heading sidebar-heading">Most Recent Post</h3>
              <div class="post">
                <img src="assets/img/tech-watch.jpg" class="img-fluid w-50">
                <h6 class="sidebar-title"><a href="">Style Tips Every Woman Should Know</a></h6>
              </div>
              <hr>

              <div class="post">
                <img src="assets/img/time-invest.jpg" class="img-fluid w-50">
                <h6 class="sidebar-title"><a href="">The key is in investing in time</a></h6>
              </div>
             


              <h3 class="heading sidebar-heading mt-5 pt-3">Popular Post</h3>
              <div class="post">
                <img src="assets/img/car.jpg" class="img-fluid w-50">
                <h6 class="sidebar-title"><a href="">Most watched sports in the world</a></h6>
              </div>
              <hr>

              <div class="post">
                <img src="assets/img/men-fashion.jpg" class="img-fluid w-50">
                <h6 class="sidebar-title"><a href="">Winter Men fashion trend</a></h6>
              </div>
              
              <br>
              <form action="" class="bg-white my-5 p-3">
                <h5><b>Subscribe to stay updated with our latest posts. Never miss a post!.</b> </h5>
                <div class="input-group mb-3">
                  <input type="text" name="email" class="form-control search-input" placeholder="Enter Email">
                  <div class="input-group-append">
                    <input type="submit" name="subscribe" value="Subscribe" class="input-group-text input-btn">
                  </div>
                </div>
              </form>
              <br>


              <h3 class="heading sidebar-heading mt-5 pt-3">Get in touch with us</h3>
              <ul class="social-icons">
                <li><a href=""><span class="fab fa-facebook fa-2x"></span></a></li>
                <li><a href=""><span class="fab fa-whatsapp fa-2x"></span></a></li>
                <li><a href=""><span class="fab fa-instagram fa-2x"></span></a></li>
                <li><a href=""><span class="fab fa-twitter fa-2x"></span></a></li>
                <li><a href=""><span class="fab fa-linkedin fa-2x"></span></a></li>
              </ul>
              <br>


              <br>
              <div id="admin-profile" class="text-center my-5 bg-white p-4">
                <img src="assets/img/admin-img.jpg" class="img-fluid rounded-circle w-50">
                <p class="py-3">
                  Hi, My name is Stepheny, welcome to my space. Here I share trans...
                </p>

                <a href="" id="profile-btn">visit My Profile</a>
              </div>
            </div>
          </div>
        </aside>
    </div>
  </div>
</main>






<footer class="bg-dark pt-5 pb-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-2 py-2">
            <div class="q-links">
              <h5 class="f-head">Labels</h5>
              <ul class="link-list">
                <li> <a href="" class="q-link">home</a></li>
                <li> <a href="" class="q-link">Food</a></li>
                <li> <a href="" class="q-link">Fashion</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-2 py-2">
            <div class="q-links">
              <h5 class="f-head">Labels</h5>
              <ul class="link-list">
                <li> <a href="" class="q-link">Education</a></li>
                <li> <a href="" class="q-link">Tech</a></li>
                <li> <a href="" class="q-link">Sports</a></li>
              </ul>
             
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 py-2" >
            <div class="newsletter">
              <h5 class="f-head">stay connected</h5>
              <p>Join over 10, 300 people who receive weekly latest updates</p>
              <form action="">
                <div class="input-element">
                  <input type="email" name="email" id="email-input" placeholder="Email">
                  <input type="submit" name="submit" value="Subscribe" class="sub-btn"><i class="fas fa-chevron-right"></i>
                </div>
              </form>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-3 py-2">
            <div class="follow-us" >
              <h5 class="f-head">let's connect</h5>
              <div class="connect-items">
                <div class="social">
                  <a href="" ><i class="fab fa-facebook-f"></i></a>
                  <a href="" ><i class="fab fa-instagram"></i></a>
                  <a href="" ><i class="fab fa-twitter"></i></a>
                  <a href="" ><i class="fab fa-telegram"></i></a>
                  <a href="" ><i class="fab fa-youtube"></i></a>
                  <a href="" ><i class="fab fa-whatsapp"></i></a>
                </div>
                <div class="phone-contact">
                  <a href="tel:+234012345678"><i class="fas fa-phone-alt"></i> +234(0)12345678</a>
                </div>
                <div class="mail-contact">
                 <a href="mailto:support@nigerianfoodtv.com"><i class="fas fa-envelope"></i> support@nigerianfoodtv.com</a>
                </div>
              </div>
           </div>
          </div>
        </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>

  <!--footer 2-->
  <div class="container-fluid">
    <div class="row align-items-center justify-content-center copy mt-3">
      <div class="col-12 text-center text-white py-3">
    <div>&copy; 2022 All rights Reserved |  <span class="text-success"><b>TutaBlog</b></span></div>
      </div>
    </div>
  </div>
</footer>








    <!--Fontawesome js-->
    <script src="assets/js/all.min.js"></script>

    <!--jQuery js-->
    <script src="assets/js/jQuery3.6.0.min.js"></script>

    <!--Boostrap 4 js-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!--Owl carousel js-->
    <script src="assets/js/owl.carousel.min.js"></script>

     <!--AOS Library-->
     <script src="assets/js/aos.js"></script>

    <!--custom js-->
    <script src="assets/js/main.js"></script>
</body>
</html>