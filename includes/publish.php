<?php
require_once 'PHPMailer.php'; 
require_once 'SMTP.php'; 
require_once 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../includes/Bank.php';
?>








<?php if (isset($_GET['slug'])) : ?>
    <?php 
    
        $slug = $_GET['slug'];
        $stmt = $conn->prepare("UPDATE posts SET published = ? WHERE slug = ?");
        $stmt->execute([1, $slug]);

        $stmt = $conn->prepare("SELECT * FROM posts WHERE slug = ?");
        $stmt = $conn->prepare('SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE posts.slug = ?');

        $stmt->execute([$slug]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $stmt = $conn->prepare("SELECT name, email FROM subscribers");
        $stmt->execute();
        $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $content = $post['body'];
        $excerpt = substr($post['body'], 0, 400)."...";
        $date = date('M d, Y ', strtotime($post['created_at']));
        $title = $post['title'];
        $image = $post['image'];
        $category_id = $post['category_id'];
        
    ?>
        
    <?php foreach($subscribers as $subscriber) : ?>
        <?php $name = $subscriber['name'] ?>
        <?php 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp-relay.sendinblue.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "oluchi.web@gmail.com";
            $mail->Password = "QXG1rF58LZqjs7pB";
    
            $mail->isHTML(true);
            $mail->Subject = "Top Post on TutaBlog: $title";
            $mail->setFrom("oluchi.web@gmail.com", "Tutablog");
            $mail->AddEmbeddedImage($image, 'Image');
            $mail->Body = "
            <p> Hi <b> $name </b></p>
            <p> Check out our newly published article that has been viewed by thousands, don't be left out,
            click the link below to read....</p>
            <div class='col-md-6 mb-5'>
            <div class='post-content'>
                <div class='post-img'>
                    <a  href='http://localhost/tutablog/single-post.php?slug=$slug&id=$category_id'>
                    <img alt='Featured image' src='cid:Image'>
                    </a>
                </div>
                <div class='post-date'>$date</div>
                <div class='post-title'>
                    <h3 class='text-primary'>
                    <a  href='http://localhost/tutablog/single-post.php?slug=$slug&id=$category_id'>$title</a> 
                    </h3>
                </div>
                <p class='excerpt'>$excerpt</p>
                <div class='readmore text-right'>
                <a  href='http://localhost/tutablog/single-post.php?slug=$slug&id=$category_id'>Click here to read</a>
                </div>
            </div>
                <br>
                <br>
            <b>Best Regards </b> 
            Oluchi Cassidy for tutablog'
        </div>";
            $mail->addAddress($subscriber['email']);
            
            if( $mail->send()){
                  header("Location: ../admin-manage-post.php?success");
                }else{
                  header("Location: ../admin-manage-post.php?partial");
        
                }
        ?>

    <?php endforeach ?>

   

       


  







<?php endif?>









