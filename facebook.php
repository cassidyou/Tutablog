<?php
include_once 'includes/Bank.php';

    global $conn;
    $stmt = $conn->prepare('SELECT  posts.*, category.id AS category_id, category.category_name
    FROM posts 
    JOIN post_category
    ON posts.id = post_category.post_id
    JOIN category 
    ON post_category.category_id = category.id
    WHERE posts.id = ?');

    $stmt->execute([13]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // $stmt = $conn->prepare("SELECT name, email FROM subscribers");
    // $stmt->execute();
    // $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $content = $post['body'];
    $excerpt = substr($post['body'], 0, 400)."...";
    $title = $post['title'];
    $image = $post['image'];

    
   
    


    require_once __DIR__.'/vendor/autoload.php';

   
    $fb = new Facebook\Facebook([
        'app_id' => '838326420482072',
        'app_secret' => '9a101697382f3782d6dfaeef1ff06859',
        'default_graph_version' => 'v2.2'
    ]);


    $message = [
        'message'=> $excerpt,
        'title' => $title,
        // 'picture' => $image
        // 'description' => 'Tutablog is an education and information blog',
        // 'caption' => 'PHP GraphAPI',
        // 'link' => 'https://localhost/tutablog/index.php'
        
    ];

    $pageAccessToken = 'EAAL6dBRZCqBgBAP6CYfV70aPbUWXweAD1MasXgZAJVLsKLPsx4GqSegpYws4lXUazRz6fgA3XSAHvPDZC3dP8aPZCJzSFYDhLLzSHMthNBZAJkUSYOgAA9c7NaVe1UQb2zDafePIqNyEQ6j73yyXL5ZApDMqBRy90098eHjvR2EStX5wAHajwv';
    try{
        $reponse = $fb->post('me/feed', $message, $pageAccessToken);
    }catch( Facebook\Exceptions\FacebookResponseException $e){
        echo "Graph returned an error: ".$e->getMessage();
    }catch(Facebook\Exceptions\FacebookSDKException $e){
        echo 'Facebook SDK returned an error: '.$e->getMessage();
        exit;
    }

  
?>