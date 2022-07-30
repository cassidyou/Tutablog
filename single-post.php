<?php require_once './blog-config.php';
require_once 'includes/Bank.php';



$slug = $_GET['slug'];
$category_id = $_GET['id'];

$posts = getSinglePost($slug);
// print_r($posts);
$postsCategory = getPostByCategory($category_id); 

$userIP = getIPAddress();
$post_id = $posts[0]['id'];

$result = registerPageView($userIP, $post_id);
print_r($result);




?>
<?php require_once 'includes/header.php' ?>


    <title>Blog Post</title>
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="rSo1xXDY"></script>
    <style>
        .post-content:hover,
        .post-img img:hover
        {
            transform: none;
        }
        .post-text{
            padding: 10px 30px;
            overflow-wrap: break-word;
            line-height: 2rem;
        }

        @media screen and(max-width: 700px) {
            .post-text{
              padding: 10px!important;
              font-size: .5rem;
              overflow-wrap: break-word;
          }
        }


        .paragraph{
            font-size: 1.2rem;
            font-family: sans-serif;
        }

        .post-date{
            padding-left: 0;
        }

        .post-title h3{
            margin-left: 0;
        }
        .comment{
          display: flex;
          align-items: flex-start;
          justify-content: flex-start;
          flex-direction: row;
          background: white;
          border-radius: 10px;
          padding: 20px;
          margin: 10px 0;
        }
        

    </style>

<!--header-->

 <?php include_once 'includes/navbar.php' ?>
 <div id="titleHint"></div>

<main>
  <!--Carousel section-->
<?php include_once 'includes/carousel.php'  ?>


  <!----------------------------------------- Fashion ------------------------------------------------>
  <div class="container">
    <div class="row" id="blog">
    
        <div class="blog-post col-lg-9">
          <div class="direction mb-4">
              
              <a href="index.php">Home</a> > <a href=category-page.php?id=<?php echo $postsCategory[0]['category_id']?>><?php echo $postsCategory[0]['category_name']?></a> > <?php echo $posts[0]['title'] ?>
              <?php foreach($posts as $post) :?>
            <?php 
                $title = $post['title'];
                $date = $date = date('M d, Y ', strtotime($post['created_at']));;
                $content = $post['body'];
                $image = $post['image'];
                $slug = $post['slug'];
                $image = $post['image'];

            ?>

          </div>
            <div class="row">
              <div class="col-12">
                    <div class="post-content">
                      <div class="post-img">
                        <img src="<?php echo $image ?>" class="h-50 img-fluid">
                      </div>
                      <div class="post-text">
                          <div class="post-date">
                            <?php echo $date ?>
                          </div>
                          <div class="post-title">
                          <h2 class="text-dark text-left"><b><?php echo $title?></b> </h2>
                          </div>
                      
                          <div class="paragraph"><?php  echo $content ?></div>
                      </div>
                    </div>
              </div>
            </div>
        <br><br>
        <h3 class="heading sidebar-heading mt-5 pt-3">Share this post</h3>
              <ul class="share-social-icons d-flex">
                <li><a href=""><span class="fab fa-facebook mx-3"></span></a></li>
                <li><a href=""><span class="fab fa-whatsapp  mx-2"></span></a></li>
                <li><a href=""><span class="fab fa-instagram  mx-2"></span></a></li>
                <li><a href=""><span class="fab fa-twitter  mx-2"></span></a></li>
                <li><a href=""><span class="fab fa-linkedin  mx-2"></span></a></li>
              </ul>

              <!-- <?php $url =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

              <div class="fb-share-button" data-href="<?php echo $url ?>" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url ?>" class="fb-xfbml-parse-ignore">Share</a></div> -->
              <br><br>


              <h1>Leave a Comment</h1>
              <div class="row my-3">
                <div class="col-md-12">
                
                <input type="text" id="user_name" class="form-control my-3" placeholder="Enter your name">

                 <textarea class="form-control" id="main_comment" placeholder="Enter comment"  rows="7"></textarea>
                 <div id="post_id" style="color:#f7f8f9 ;"><?php echo $post['id'] ?></div>
                 <button class="btn btn-primary" style="float: right;" id="add_comment">Add comment</button>


                  
              
                </div>
              </div>
              <div class="container-fluid">
                <div class="row my-5">
                <div><b id="totalComment"></b></div> 
                
                </div>
                <div class="row mb-5">
                  <div class="user-comments">
                  
                    
                  </div>
                </div>
              </div>

             
               

      </div>
    <?php endforeach?>
   
     

          <!------------------------------------------------ Side Bar ------------------------------------------------------------>
        <?php include_once 'includes/sidebar.php' ?>
    </div>
  </div>
</main>





<?php require_once 'includes/footer.php' ?>

<script>
  
  $(document).ready(function(){
    commentCount();
    getComments();


  
    function commentCount(){
      var post_id = $("#post_id").text();
      $.ajax({
          url: 'includes/comments.php',
          method: 'POST',
          dataType: 'text',
          data: {
            getTotalcomments: 1, 
            post_id: post_id
          },
          success: function(response){
              $("#totalComment").text(`${response} Comments`);
          }
        });
    }
    
    function getComments(){
      var post_id = $("#post_id").text();
      $.ajax({
          url: 'includes/comments.php',
          method: 'POST',
          dataType: 'text',
          data: {
            getcomments: 1, 
            post_id: post_id
          },
          success: function(response){
              $(".user-comments").append(response);
          }
        });
    }

    $("#add_comment").on('click', function(){
      var comment = $("#main_comment").val();
      var post_id = $("#post_id").text();
      var user_name = $("#user_name").val();

      if(comment.length > 5 && user_name.length > 3){
        $.ajax({
          url: 'includes/comments.php',
          method: 'POST',
          dataType: 'text',
          data: {
            add_comment: 1, 
            comment: comment,
            post_id: post_id,
            user_name: user_name
            
          },
          success: function(response){
              $(".user-comments").prepend(response);
              $('#main_comment').val("");
              $('#user_comment').val("");
              
          }
        });

        //Get total comment
        commentCount();

      }else{
        alert("please fill all fields")
      }

    

      //get comments
    
        

    });
    
    


  });

  
</script>