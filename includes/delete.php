<?php 
require_once '../blog-config.php';
require_once 'Bank.php';


if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
   $posts = getSinglePost($slug);
  
   
   $source_id = $_SESSION['id'];
   $post_id = $posts['0']['id'];
   $title = 'Deleted a post';
   $post_title = $posts['0']['title'];
   $message = 'Deleted a post titled <b><i>'.strtoupper($post_title).'</i></b>';

 

   //Fetching the data of All the Admins
   $sql = $conn->prepare("SELECT id FROM users WHERE role = ?");
   $sql->execute(["Admin"]);
   $results = $sql->fetchAll(PDO::FETCH_ASSOC);

   foreach($results as $admin_id){
     $stmt = $conn->prepare("INSERT INTO notification (destination_id, source_id, post_id, title, message) 
                           VALUES (?, ?, ?, ?, ?)");
     $stmt->execute([$admin_id['id'], $source_id, $post_id, $title, $message ]);  
   }

    // echo "delete is pending";
   $stmt = $conn->prepare("DELETE FROM posts WHERE slug = ?");
   $stmt->execute([$slug]);

   header("Location: ../admin-manage-post.php?deleted");
}