<?php
require_once '../blog-config.php';
require_once 'PHPMailer.php'; 
require_once 'SMTP.php'; 
require_once 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../includes/Bank.php';
require_once '../vendor/autoload.php';

?>








<?php if (isset($_GET['slug'])) : ?>
    <?php 

    
    
        global $conn;

        $slug = $_GET['slug'];
        $stmt = $conn->prepare("UPDATE posts SET published = ? WHERE slug = ?");
        $stmt->execute([1, $slug]);

        //Getting posts information
        $sql = $conn->prepare('SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE posts.slug = ?');

        $sql->execute([$slug]);
        $post = $sql->fetch(PDO::FETCH_ASSOC);
        
        
        
        //Inserting notification into the notification table
        $destination_id = $post['user_id'];
        $source_id = $_SESSION['id'];
        $post_id = $post['id']; 
        $post_title = $post['title'];
        $title = 'Published your post';
        $message = 'Your post titled <b><i>'.strtoupper($post_title).'</i></b> has been reviewed and published.';

        $stmt = $conn->prepare("INSERT INTO notification (destination_id, source_id, post_id, title, message) 
                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$destination_id, $source_id, $post_id, $title, $message]);
 
    
        //Getting subscribers
        $stmt = $conn->prepare("SELECT name, email FROM subscribers");
        $stmt->execute();
        $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $content = $post['body'];
        $excerpt = htmlspecialchars_decode(substr($post['body'], 0, 400)."...");
        $date = date('M d, Y ', strtotime($post['created_at']));
        $title = $post['title'];
        $image = $post['image'];
        $category_id = $post['category_id'];
        

        // Autoposting to Facebook page
        $fb = new Facebook\Facebook([
            'app_id' => '838326420482072',
            'app_secret' => '9a101697382f3782d6dfaeef1ff06859',
            'default_graph_version' => 'v2.2'
        ]);


        $message = [
            // 'caption' => $title,
            'message'=> strtoupper($title)."\n \n" .$excerpt,
            
            // 'picture' => $image
            // 'description' => 'Tutablog is an education and information blog',
            // 'caption' => 'PHP GraphAPI',
            // 'link' => 'http://localhost/tutablog/single-post.php?slug='.$slug.'&id='.$category_id,
            
            
        ];

        // $pageAccessToken = your access token;
    try{
        $reponse = $fb->post('me/feed', $message, $pageAccessToken);
    }catch( Facebook\Exceptions\FacebookResponseException $e){
        echo "Graph returned an error: ".$e->getMessage();
    }catch(Facebook\Exceptions\FacebookSDKException $e){
        echo 'Facebook SDK returned an error: '.$e->getMessage();
        exit;
    }
   
     
        
    ?>

    

    <!-- Sending notification to subscribers -->
    <?php foreach($subscribers as $subscriber) : ?>
        <?php $name = $subscriber['name'] ?>
        <?php 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp-relay.sendinblue.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "Your username";
            $mail->Password = "Your password";
    
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
                <p>If you don't want to receive notifications about our new blog post, please click 
                    <a http://localhost/tutablog/unsubscribe.php> Unsubscribe</a>
                </p>
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









