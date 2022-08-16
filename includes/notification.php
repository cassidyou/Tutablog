<?php 


include_once '../blog-config.php';
include_once 'Bank.php';
if(isset($_GET['q'])){
    $q =$_GET['q'];

    $count = countNotifications($q);

    echo $count;
}

if(isset($_GET['r'])){
    $r = $_GET['r'];
    $notification = getNotifications($r);
}




if(isset($_POST['getlikes'])){
    $post_id = htmlspecialchars($_POST['post_id']);
    echo getLikes($post_id);
}


if(isset($_POST['read_all'])){
    $user_id = $_POST['user_id'];

    $result = markAllAsRead($user_id);
    echo $result;
    
}


if(isset($_POST['read_one'])){
    $notification_id = $_POST['notification_id'];

   global $conn;
   $result = markAsRead($notification_id);
   echo $result;
    
}



