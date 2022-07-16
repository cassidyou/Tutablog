<?php
function getPublishedPosts(){
    global $conn;
    $sql = "SELECT * FROM posts WHERE published = ture";
}



