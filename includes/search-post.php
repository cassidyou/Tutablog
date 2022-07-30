<?php 

include_once '../blog-config.php';
include_once 'Bank.php';
$q =$_GET['q'];
$posts = searchPostByTitle($q);

echo "<div id='title-hint'>";
foreach($posts as $post){
    $slug = $post['slug'];
    $category_id = $post['category_id'];
    $title = $post['title'];

    echo "<a class='title' href=./single-post.php?slug=$slug&id=$category_id> $title </a>". "<br>";
    
}
echo "</div>";
