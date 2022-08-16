<?php 
$categories = getCategory(); 
$popularposts = popularPosts(2);
// print_r($popularposts);
$recentPosts = mostRecentPosts(2);

?>

<aside class="sidebar col-lg-3"> 

          <form action="" class="search-form">
            <div class="input-group mb-3">
              <input type="text" name="search" class="form-control search-input" placeholder="Enter keyword" onkeyup="showPostByTitle(this.value)">
              <!-- <div class="input-group-append">
                <input type="submit" value="Search" class="input-group-text input-btn search-btn">
              </div> -->
            </div>
          </form>
          <hr>

          <div id="postHint"></div>

          <div id="sidebar">
            <div class="content">
              <h3 class="heading sidebar-heading">Categories</h3>
              <ul class="ml-3" id="categories">
                <?php foreach($categories as $category) : ?>
                 <li><a href=category-page.php?id=<?php echo $category['id'] ?>><?php echo $category['category_name'] ?></a></li>
                <?php endforeach?>
              </ul>
            </div>
            
            <div id="latest-post" class="content my-5">
              <h3 class="heading sidebar-heading">Most Recent Post</h3>
              
                <?php foreach($recentPosts as $recentPost) : ?>
                  <div class="post">  
                      <?php echo "<img src=uploads/".$recentPost['image']." class='img-fluid w-50'>"  ?>    
                      <a class="sidebar-title" href=single-post.php?slug=<?php echo $recentPost['slug'] ?>&id=<?php echo $recentPost['category_id'] ?>>
                        <?php echo $recentPost['title'] ?>
                      </a>
                      
                  </div>
                  <hr>
                <?php endforeach  ?>
                
             
        

             
             


              <h3 class="heading sidebar-heading mt-5 pt-3">Popular Post</h3>

              <?php foreach($popularposts as $popularPost) : ?>
                <div class="post">
                <?php echo "<img src=uploads/".$popularPost['image']." class='img-fluid w-50'>"  ?>   
                <a class="sidebar-title" href=single-post.php?slug=<?php echo $popularPost['slug'] ?>&id=<?php echo $popularPost['category_id'] ?>>
                        <?php echo $popularPost['title'] ?>
                      </a>
              </div>
              <hr>

              <?php endforeach ?>

           
              
              <br>
              <form id="sub-form" class="bg-white my-5 p-3">
                <h5><b>Subscribe to stay updated with our latest posts. Never miss a post!.</b> </h5>
                <div id="demo">demo</div>
                <div><small id="Err" class="text-danger"></small></div>
                 <input type="text" name="name" id="name" class="form-control my-3" placeholder="Enter your name">
                <div class="input-group mb-3">
                 
                  <input type="text" name="email" id="email" class="form-control search-input" placeholder="Enter Email">
                  <div class="input-group-append">
                    <input type="submit" name="subscribe" onclick="loadDoc(), reset()" value="Subscribe" class="input-group-text input-btn">
                  </div>
                </div>
                
              </form>
              <br>


              <h3 class="heading sidebar-heading mt-5 pt-3">Get in touch with us</h3>
              <ul class="social-icons">
                <li><a href="https://web.facebook.com/marriageslaws"><span class="fab fa-facebook fa-2x"></span></a></li>
                <li><a href="https://wa.me/message/5Y5DSSISWG3BB1"><span class="fab fa-whatsapp fa-2x"></span></a></li>
                <li><a href="https://www.instagram.com/oluchicassidy/?hl=en"><span class="fab fa-instagram fa-2x"></span></a></li>
                <li><a href="https://twitter.com/OluchiCassidy1"><span class="fab fa-twitter fa-2x"></span></a></li>
              
              </ul>
              <br>


              <br>
              <!-- <div id="admin-profile" class="text-center my-5 bg-white p-4">
                <img src="assets/img/admin-img.jpg" class="img-fluid rounded-circle w-50">
                <p class="py-3">
                  Hi, My name is Stepheny, welcome to my space. Here I share trans...
                </p>

                <a href="" id="profile-btn">visit My Profile</a>
              </div> -->
            </div>
          </div>
        </aside>


<script>
  function loadDoc() {
    var nameField = document.getElementById("name");
    var emailField = document.getElementById("email");
    let name = nameField.value;
    let email = emailField.value;
    document.getElementById("sub-form").addEventListener("click", function(e){
      e.preventDefault();
    })
    
    
   
      

      const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("demo").innerHTML = this.responseText;
    }
    xhttp.open("POST", "includes/subscribe.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`name=${name}&email=${email}`);
  }


  function reset(){
    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
  }
</script>