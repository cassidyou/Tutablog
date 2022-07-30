<?php 
require_once 'Bank.php';

if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
   $posts = getSinglePost($slug);


// echo "delete is pending";

   $stmt = $conn->prepare("DELETE FROM posts WHERE slug = ?");
   $stmt->execute([$slug]);

   header("Location: ../admin-manage-post.php?deleted");
}