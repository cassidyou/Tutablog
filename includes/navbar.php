<?php
$foodPosts = getPostsByLimit('food', 4); 


?>
<div class="toppest">
   <div>Lorem, ipsum.</div>
   <div class="social-connect">
   <li><a href=""><span class="fab fa-facebook"></span></a> </li>
   <li><a href=""><span class="fab fa-linkedin"></span></a> </li>
   <li><a href=""><span class="fab fa-twitter"></span></a> </li>
   <li><a href=""><span class="fab fa-whatsapp"></span></a> </li>
   <li><a href=""><span class="fas fa-envelope"></span></a> </li>
   <li><a href=""><span class="fa fa-phone"></span></a> </li>
   </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">TutaBlog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="">menu</span>
    </button>
  
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto text-dark">
       <li class="nav-item li-food">
        <span class="nav-link">Food <span class="fa fa-chevron-down chevron-down"></span></span>

        <!-------------------------- Dropdown menu ------------------------------------------>
        <div class="dropdown-items-food">
          <div class="containerfluid">
            <div class="row">
              <?php foreach($foodPosts as $post) : ?>
                <div class="col-lg-3 drop-item">
                  <div class="img-container">
                    <a href=single-post.php?slug=<?php echo $post['slug'] ?>&id=<?php echo $post['category_id'] ?>>
                    <img src="<?php echo $post['image']  ?>" class="img-fluid dropdown-img">
                  </a>
                  </div>
                  <div>
                    <h5 class="dropdown-title">
                    <a href=single-post.php?slug=<?php echo $post['slug'] ?>&id=<?php echo $post['category_id'] ?>>
                      <?php echo $post['title'] ?>
                  </a>
                    </h5>
                    <span class="text-secondary">By <?php echo $post['author_firstname'] ?></span>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>

       </li>
       <li class="nav-item li-fashion">
        <span class="nav-link">Fashion <span class="fa fa-chevron-down chevron-down"></span></span>

         <!-------------------------- Dropdown menu ------------------------------------------>
         <div class="dropdown-items-fashion">
          <div class="containerfluid">
            <div class="row">
              <?php $fashionPosts = getPostsByLimit('fashion', 4);   ?>
            <?php foreach($fashionPosts as $postf) : ?>
                <div class="col-lg-3 drop-item">
                  <div class="img-container">
                    <a href=single-post.php?slug=<?php echo $postf['slug'] ?>&id=<?php echo $postf['category_id'] ?>>
                    <img src="<?php echo $postf['image']  ?>" class="img-fluid dropdown-img">
                  </a>
                  </div>
                  <div>
                    <h5 class="dropdown-title">
                    <a href=single-post.php?slug=<?php echo $postf['slug'] ?>&id=<?php echo $postf['category_id'] ?>>
                      <?php echo $postf['title'] ?>
                  </a>
                    </h5>
                    <span class="text-secondary">By <?php echo $postf['author_firstname'] ?></span>
                  </div>
                </div>
              <?php endforeach ?>

              
            </div>
          </div>
        </div>
       </li>
       
       <li class="nav-item li-explore">
        <span class="nav-link">Explore <span class="fa fa-chevron-down chevron-down"></span></span>
         <!-------------------------- Dropdown menu ------------------------------------------>
         <div class="dropdown-items-explore">
          <div class="containerfluid">
            <div class="row">
              <div class="col-lg-2">
                <h4><b>Living</b></h4>
                <ul>
                  <li><a href="">Education</a></li>
                  <li><a href="">Relationships</a></li>
                </ul>
              </div>
              <div class="col-lg-2">
                <h4><b>Arts</b></h4>
                <ul>
                  <li><a href="">Movies</a></li>
                  <li><a href="">Music</a></li>
                </ul>
              </div>
              <div class="col-lg-2">
                <h4><b>Fashion</b></h4>
                <ul>
                  <li><a href="">Women Fashion</a></li>
                  <li><a href="">Men Fashion</a></li>
                </ul>
              </div>
              <div class="col-lg-2">
                <h4><b>Lifestyle</b></h4>
                <ul>
                  <li><a href="">Beauty</a></li>
                  <li><a href="">Travel</a></li>
                </ul>
              </div>
              <div class="col-lg-2">
                <h4><b>Sports</b></h4>
                <ul>
                  <li><a href="">Football</a></li>
                  <li><a href="">Basketball</a></li>
                </ul>
              </div>
              <div class="col-lg-2">
                <h4><b>Food</b></h4>
                <ul>
                  <li><a href="">African</a></li>
                  <li><a href="">American</a></li>
                </ul>
              </div>
             
              
            </div>
          </div>
        </div>
       </li>
      </ul>
      <form method="post" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search for post" onkeyup="showTitle(this.value)">
        
      </form>
      <div class="blog-date d-none d-lg-flex"> 
        <div class="day ml-5 mr-2"> <h2>9</h2></div>
        <div class="month-year">
          <li class="year">July</li>
          <li class="month">2022</li>
        </div>
      </div>
    </div>
  </nav>
  
  <style>
    #titleHint,
    #postHint{
      display: absolute;
    }
  </style>


  <script>
    function showTitle(str){
      if(str == ""){
        document.getElementById("titleHint").innerHTML = "";
        return;
      }else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./includes/search-post.php?q=" + str, true);

        xmlhttp.onload = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("titleHint").innerHTML = this.responseText;
          }else{
            alert("Error: " + xmlhttp.status);
            alert("Error: " + xmlhttp.statusText);
          }
        };
        xmlhttp.send();
      }
    }

    function showPostByTitle(str){
      if(str == ""){
        document.getElementById("postHint").innerHTML = '';
        return;
      }else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./includes/search-post.php?q=" + str, true);

        xmlhttp.onload = function(){
          if(this.readyState == 4 && this.status == 200){
            document.getElementById("postHint").innerHTML = this.responseText;
          }else{
            alert("Error: " + xmlhttp.status);
            alert("Error: " + xmlhttp.statusText);
          }
        };
        xmlhttp.send();
      }
    }
    
  </script>

