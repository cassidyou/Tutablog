<?php

   

    //function to establish database connection
function db_connect($servername, $dbname,$username, $password){
        try{
            $dsn = "mysql:host=$servername;dbname=$dbname";
            $connection = new PDO($dsn, $username, $password);
            return $connection;
        }catch(PDOException $e){
            print "Error!: ".$e->getMessage();
        }
    }


    //function to fetch all published post
function getPublishedPosts(){
    $conn = db_connect("localhost","tutablogdb","root","");
    $stmt = $conn->prepare('SELECT * FROM posts WHERE published = ?');
       $stmt->execute([true]);
       $published_post = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $published_post;
    }

    

