<?php 
include_once '../blog-config.php';
include_once 'Bank.php';


if(isset($_POST['add_comment'])){
    $comment = htmlspecialchars($_POST['comment']);
    $user_name = htmlspecialchars($_POST['user_name']);
    $post_id = htmlspecialchars($_POST['post_id']);

    registerComment($post_id, $user_name, $comment);
    
}

// Get total number of comments

if(isset($_POST['getTotalcomments'])){
    $post_id = htmlspecialchars($_POST['post_id']);
    $totalComment = totalComment($post_id);
    echo $totalComment;
}

// Get all comments
if(isset($_POST['getcomments'])){
    $post_id = htmlspecialchars($_POST['post_id']);
    $comments = getComments($post_id);
    echo $comments;
}


//register likes
if(isset($_POST['likes'])){
    $post_id = htmlspecialchars($_POST['post_id']);
    $user_ip = htmlspecialchars($_POST['user_ip']);

   echo registerLikes($post_id, $user_ip);
}


//get likes 
if(isset($_POST['getlikes'])){
    $post_id = htmlspecialchars($_POST['post_id']);
    echo getLikes($post_id);
}


//register replies
if(isset($_POST['reply'])){
    $username = cleanInput($_POST['username']);
    $reply = cleanInput($_POST['reply']);
    $comment_id = $_POST['comment_id'];

    //registers the replies
    $replies = registerReplies($comment_id, $username, $reply);
   
   echo $replies;
    
}

//get replies count
if(isset($_POST['get_reply_count'])){
    $comment_id = $_POST['comment_id'];

    $reply = getRepliesCount($comment_id);
    echo $reply. " replies";
    

}




?>