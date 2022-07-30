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







?>