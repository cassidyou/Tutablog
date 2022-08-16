<?php
$foodPosts = getPostsByLimit('food', 4); 

$fashions = getPostsByLimit('fashion', 2); 
$foods = getPostsByLimit('food', 2); 
$commerces = getPostsByLimit('commerce', 2); 
$engineerings = getPostsByLimit('engineering', 2); 
$energys = getPostsByLimit('energy', 2); 
$travels = getPostsByLimit('travel', 2);

// print_r($energys)




?>




<div class="toppest">
   <div id="welcome-text" class="d-none d-md-block"></div>
   <div class="social-connect">
      <li><a href="https://web.facebook.com/marriageslaws"><span class="fab fa-facebook"></span></a> </li>
      <li><a href="https://www.instagram.com/oluchicassidy/?hl=en"><span class="fab fa-instagram"></span></a></li>
      <li><a href="https://twitter.com/OluchiCassidy1"><span class="fab fa-twitter"></span></a> </li>
      <li><a href="https://wa.me/message/5Y5DSSISWG3BB1"><span class="fab fa-whatsapp"></span></a> </li>
      <li><a href="mailto: ndukweokorouduma@gmail.com"><span class="fas fa-envelope"></span></a> </li>
      <li><a href="Tel: 08130855737"><span class="fa fa-phone"></span></a> </li>
   </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">TutaBlog</a>
    <div class="border-none">
     <span class="day"></span>
     <span class="month"></span>
     <span class="year"></span>
    </div>

   
  
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
                   
                    <?php echo "<img src=uploads/".$post['image']." class='img-fluid dropdown-img'>" ?>
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
                    <?php echo "<img src=uploads/".$postf['image']." class='img-fluid dropdown-img'>" ?>
                    
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
              <div class="col-lg-3">
                <h4><b><?php echo $travels['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($travels as $travel) : ?>
                    <li><a href=single-post.php?slug=<?php echo $travel['slug'] ?>&id=<?php echo $travel['category_id'] ?>><?php echo $travel['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <div class="col-lg-3">
                <h4><b><?php echo $engineerings['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($engineerings as $engineering) : ?>
                    <li><a href=single-post.php?slug=<?php echo $engineering['slug'] ?>&id=<?php echo $engineering['category_id'] ?>><?php echo $engineering['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <div class="col-lg-3">
                <h4><b><?php echo $commerces['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($commerces as $commerce) : ?>
                    <li><a href=single-post.php?slug=<?php echo $commerce['slug'] ?>&id=<?php echo $commerce['category_id'] ?>><?php echo $commerce['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <div class="col-lg-3">
                <h4><b><?php echo $foods['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($foods as $food) : ?>
                    <li><a href=single-post.php?slug=<?php echo $food['slug'] ?>&id=<?php echo $food['category_id'] ?>><?php echo $food['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-lg-3">
                <h4><b><?php echo $fashions['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($fashions as $fashion) : ?>
                    <li><a href=single-post.php?slug=<?php echo $fashion['slug'] ?>&id=<?php echo $fashion['category_id'] ?>><?php echo $fashion['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <div class="col-lg-3">
                <h4><b><?php echo $energys['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($energys as $energy) : ?>
                    <li><a href=single-post.php?slug=<?php echo $energy['slug'] ?>&id=<?php echo $energy['category_id'] ?>><?php echo $energy['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <!-- <div class="col-lg-3">
                <h4><b><?php echo $commerces['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($commerces as $commerce) : ?>
                    <li><a href=single-post.php?slug=<?php echo $commerce['slug'] ?>&id=<?php echo $commerce['category_id'] ?>><?php echo $commerce['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div>
              <div class="col-lg-3">
                <h4><b><?php echo $foods['0']['category_name'] ?></b></h4>
                <ul>
                  <?php foreach($foods as $food) : ?>
                    <li><a href=single-post.php?slug=<?php echo $food['slug'] ?>&id=<?php echo $food['category_id'] ?>><?php echo $food['title'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </div> -->
            </div>
          </div>
        </div>
       </li>
      </ul>
      <form method="post" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search for post" onkeyup="showTitle(this.value)">
        
      </form>
      <div class="blog-date d-none d-lg-flex"> 
        <div class="day ml-5 mr-2"></div>
        <div class="month-year">
          <li class="month"></li>
          <li class="year"></li>
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



    //Date 
    let d = new Date();
    let year = d.getFullYear();
    let month = d.getMonth();
    let today = d.getDate();
    switch(month){
      case 0: 
        month = "Jan.";
        break;
      case 1: 
        month = "Feb.";
        break;
      case 2: 
        month = "Mar.";
        break;
      case 3: 
        month = "Apri.";
        break;
      case 4: 
        month = "May";
        break;
      case 5: 
        month = "Jun.";
        break;
      case 6: 
        month = "Jul.";
        break;
      case 7: 
        month = "Aug.";
        break;
      case 8: 
        month = "Sep.";
        break;
      case 9: 
        month = "Oct.";
        break;
      case 10: 
        month = "Nov.";
        break;
      case 11: 
        month = "Dec.";
        break;
    }

    document.querySelector(".year").innerHTML = year;
    document.querySelector(".month").innerHTML = month;
    document.querySelector(".day").innerHTML = today;


    //Typing and deleting effect
    const words = ["Welcome to Tutablog... The home of blogging... please explore our inexhaustible publications as it interests you"];
    let i = 0;
    let timer;

    function typingEffect() {
        let word = words[i].split("");
        var loopTyping = function() {
            if (word.length > 0) {
                document.getElementById('welcome-text').innerHTML += word.shift();
            } else {
                deletingEffect();
                return false;
            };
            timer = setTimeout(loopTyping, 200);
        };
        loopTyping();
    };

    function deletingEffect() {
        let word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
                word.pop();
                document.getElementById('welcome-text').innerHTML = word.join("");
            } else {
                if (words.length > (i + 1)) {
                    i++;
                } else {
                    i = 0;
                };
                typingEffect();
                return false;
            };
            timer = setTimeout(loopDeleting, 200);
        };
        loopDeleting();
    };

    typingEffect();
    
  </script>

