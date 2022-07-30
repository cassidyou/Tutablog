<?php include_once 'admin/header.php' ?>
<?php 


$posts = getAllPosts();
// print_r($posts);
?>

<title>Blog Post</title>
<?php include_once 'admin/navbar.php' ?>
<style>
  .post-content{
    border: 1px solid rgb(236, 234, 234);
    border-radius: 1px;
    transition: all 0.5s ease-in-out;
}

.post-content:hover{
    transform: translateY(-10px);
    
}



.post-img{
    position: relative;
    overflow: hidden;
}
.post-img img{
    width: 100%;
    height: 16rem;
    transition: all 1s ease-in-out;
}

.post-img img:hover{
    transform: scale(1.3);
  }

  .post-title h3{
    font-family: Abel;
    text-transform: uppercase;
    font-weight: bolder;
    font-size: 1.3rem!important;
  
    margin: 1rem 1rem;
}

.post-date{
    padding: .5rem 1rem;
    font-family: Abel;
    font-size: 1rem;
}

.excerpt{
    padding: 0 1rem 0 1rem;
    opacity: 0.7;
}

.post-content .readmore{
  padding:  1rem;
  text-align:center;
  margin-bottom: 1rem!important;
  display: block;
}

.readmore .read-more-btn{
    margin: 2rem!important;
    color: #000;
    text-transform: capitalize;
    position: relative;
    right: 0!important;
    font-size: 1rem;
}
</style>

                  <h5 class="page-title my-4">Blog Posts</h5>
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12 main-lay py-3">
                       

                        <div class="container">
                            <h4>Posts</h4>
                            <div class="row">
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
<div class="col-12 col-md-6 col-lg-4 mb-5">
  <div class="post-content">
    <div class="post-img">
      <a href=""><img src="<?php echo $image ?>" class="img-fluid h-50"></a>
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
                       

                        
                      </div>
                    </div>
                  </div>

<?php include_once 'admin/footer.php' ?>