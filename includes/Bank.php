<?php

require_once 'PHPMailer.php'; 
require_once 'SMTP.php'; 
require_once 'Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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

    $conn = db_connect("localhost","blogproject","root","");

    //Fetch all published post
    function getPublishedPosts($start_from, $limit){
        global $conn;
        $stmt = $conn->prepare("SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE posts.published = ?
        ORDER BY posts.id DESC LIMIT $start_from, $limit");
        $stmt->execute([true]);
        $published_post = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $published_post;
    }

    //Fetch all post
    function getAllPosts(){
        global $conn;
        $stmt = $conn->prepare('SELECT users.first_name AS author_firstname, 
                                        users.last_name AS author_lastname,
                                        posts.*, 
                                        category.id AS      category_id, 
                                        category.category_name
                                FROM    posts
                                JOIN    users 
                                ON      posts.user_id = users.id
                                JOIN    post_category
                                ON      posts.id = post_category.post_id
                                JOIN    category 
                                ON      post_category.category_id = category.id
                                ORDER by post_category.post_id 
                                DESC');
        $stmt->execute();
        $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $post;
    }


    //display a single post on a page
    function getSinglePost($slug){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM posts WHERE slug = ?');
        $stmt->execute([$slug]);
        $singlePost = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $singlePost;
    }


    function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
            $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
            $text = trim($text, $divider);

        // remove duplicate divider
            $text = preg_replace('~-+~', $divider, $text);

        // lowercase
            $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text. "-" .rand(1,10000);
    }


    //check if post is published
    function isPublished($id){
        global $conn;
        $stmt = $conn->prepare('SELECT published FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        $published = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($published as $is_publish){
            $published = $is_publish['published'];
        }
        return $published;  
    }



    //get post author
    function getAllusers(){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    //Get a single user
    function getUserById($user_id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }


    //get category
    function getCategory(){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM category');
        $stmt->execute();
        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }

    function getPostByCategory($id){
        global $conn;
        $stmt = $conn->prepare("SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE category.id = ?;");
        $stmt->execute([$id]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }



    //fetch the number of rows in the post table
    function getPostRows(){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM posts;");
        $stmt->execute();
        $row = $stmt->rowCount();
        return $row; 
    }

    //fetch the nubmer of rows in the category table

    function getCategoriesRows(){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM category;");
        $stmt->execute();
        $row = $stmt->rowCount();
        return $row; 
    }



    //clean the input data
    function cleanInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }



    //General slug from strings 
    function fixForUri($string){
        $slug = trim($string); // trim the string
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug= str_replace(' ','-', $slug); // replace spaces by dashes
        $slug= strtolower($slug);  // make it lowercase
        return $slug;
   }


   //General random name 
   function randomName($n){
    $characters = '01234567890abcdefghijklmnopqrstuvwxyzABCDEFGIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
   }


    //Get visitors Ip address
    function getIPAddress() {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    } 
    

 //Get Obtain IP information
 function getIPInfo($ip){
            // $ip = '52.25.109.230';
        
        // Use JSON encoded string and converts
        // it into a PHP variable
        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $ip));
        
        echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
        echo 'City Name: ' . $ipdat->geoplugin_city . "\n";
        echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
        echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
        echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
        echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
        echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
        echo 'Timezone: ' . $ipdat->geoplugin_timezone;
 }



    //Register IP address
    function registerPageView($IP, $post_id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM views WHERE post_id = ? AND visitor_ip = ?");
        $stmt->execute([$post_id, $IP]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       if(!$result){
            $stmt = $conn->prepare("INSERT INTO views (post_id, visitor_ip) VALUES (?, ?)");
            $stmt->execute([$post_id, $IP]);
       }
    }


    //Total page visits
    function getAllViews(){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM views");
        $stmt->execute();
        $row = $stmt->rowCount();
        return $row;
    }


    //Get user 
    function getUser($username, $password){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND active = ?;");

        $stmt->execute([$username, $username, '1']);

        if($stmt->rowCount() == 0){
            header("Location: ./user-login.php?notfound");
            exit();
        }

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $user_password =  $user['password'];
            $check_pwd = password_verify($password, $user_password);
            if($check_pwd == true){

                
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['image'] = $user['image'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['last_login'] = $user['last_login'];

                $sql = $conn->prepare("UPDATE users SET last_login = now() WHERE id = ?;");
                $sql->execute([$_SESSION['id']]);

               
                

                header("Location: ./admin-dashboard.php");
                

            }else{
                header("Location: ./user-login.php?wrongp");
                exit();
            }
          
        }
    }


    // get user posts
    function getAllUserPosts($id){
        global $conn;
        $stmt = $conn->prepare("SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE posts.user_id = ?;");

        $stmt->execute(["$id"]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    //user total posts
    function userTotalPosts($id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->rowCount();
        return $result;
    }


    //user total view
    function userTotalviews($id){
        global $conn;
        $stmt = $conn->prepare("SELECT views.*, posts.* 
                                    FROM views 
                                    JOIN posts 
                                    ON posts.id = views.post_id 
                                    WHERE posts.user_id = ?;");
        $stmt->execute([$id]);
        $result = $stmt->rowCount();
        return $result;
    }

    //Get posts under food category limit 4
    function getPostsByLImit($category_name, $num){
        global $conn;
            $stmt = $conn->prepare("SELECT users.first_name AS author_firstname, 
                                            users.last_name AS author_lastname,
                                            posts.*, 
                                            category.id AS      category_id, 
                                            category.category_name
                                    FROM    posts
                                    JOIN    users 
                                    ON      posts.user_id = users.id
                                    JOIN    post_category
                                    ON      posts.id = post_category.post_id
                                    JOIN    category 
                                    ON      post_category.category_id = category.id
                                    WHERE   category.category_name = ? 
                                    AND     posts.published = ?
                                    ORDER by post_category.post_id 
                                    DESC LIMIT $num");
            $stmt->execute([$category_name, 1]);
            $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $post;
    }



    // Most recent posts 
    function mostRecentPosts($limit){
            global $conn;
            $stmt = $conn->prepare("SELECT  posts.*, category.id AS category_id, category.category_name
            FROM posts 
            JOIN post_category
            ON posts.id = post_category.post_id
            JOIN category 
            ON post_category.category_id = category.id
            WHERE posts.published = ?
            ORDER BY posts.id DESC LIMIT $limit");
            $stmt->execute([true]);
            $published_post = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $published_post;
    }

    //Popular posts 
    function popularPosts($limit){
            global $conn;
            $stmt = $conn->prepare("SELECT COUNT(views.post_id), posts.*, views.*, 
            post_category.category_id AS category_id, category.category_name AS category_name, users.first_name, users.last_name
            FROM users
            JOIN posts 
            ON users.id = posts.user_id 
            JOIN views
            ON posts.id = views.post_id
            JOIN post_category
            ON posts.id = post_category.post_id
            JOIN category
            ON category.id = post_category.category_id
            GROUP BY posts.id
            ORDER BY COUNT(views.post_id)
            DESC LIMIT $limit");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }


    // search for post title with ajax
    function searchPostByTitle($str){
            global $conn;
            $stmt = $conn->prepare("SELECT  posts.*, category.id AS category_id, category.category_name
            FROM posts 
            JOIN post_category
            ON posts.id = post_category.post_id
            JOIN category 
            ON post_category.category_id = category.id
            WHERE posts.published = ?
            AND title LIKE '$str%'");
            $stmt->execute([1]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }
        


        // Register subscribers
        function subscribers($name, $email){
            global $conn;
            $stmt = $conn->prepare("SELECT email FROM subscribers WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->rowCount();
            
            if($result != 0){
                $output = "<div class='alert alert-warning'>Thanks.You are already subscribed to our newsletter. </div>";
                return $output;
            }
            
            if($result == 0){
                $stmt= $conn->prepare("INSERT INTO subscribers (name, email) VALUES (?, ?)");
                $stmt->execute([$name, $email]);

                $output = "<div class='alert alert-success'>Thanks for subscribing to our newsletter. </div>";
                return $output;
            }
            
        }


    //register post comment
    function registerComment($post_id, $user_name, $comment){
            global $conn;
            $stmt = $conn->prepare("INSERT INTO comments (post_id, user_name, comment) VALUES (?, ?, ?)");
            $stmt->execute([$post_id, $user_name, $comment]);
            if($stmt){
                $sql = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC LIMIT 1");
                $sql->execute([$post_id]);
                $comment = $sql->fetch(PDO::FETCH_ASSOC);
        
                // foreach($comments as $comment){
                    echo '
                    <div class="comment">
                        <img src="assets/img/avatar.png" class="rounded-circle mr-3" style="width: 40px;">
                        <div>
                            <div class="user-name"><h6><b>'.$comment['user_name'].'</b></h6> <span class="time">'.$comment['created_at'].'</span></div>
                            <div class="user-comment">'.$comment['comment'].'</div>
                        </div>
                        <!--
                        <div class="replies ml-5">
                            <div class="comment my-2">
                            <div class="user-name"><b>John Doe</b> <span class="time"> 12:00 pm</span></div>
                            <div class="user-comment">This is my comment</div>
                            </div>
                        
                        </div>

                        -->
                    </div>
                    ';
                // }
            }
    }



    //get total comment for a post 
    function totalComment($post_id){
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ?");
            $stmt->execute([$post_id]);
            $result = $stmt->rowCount();
            return $result;
    }



  // get all comments by post  ?>
  
   <?php  function getComments($post_id){
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC ");
            $stmt->execute([$post_id]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql = $conn->prepare("SELECT * FROM replies WHERE comment_id = ? ORDER BY id DESC ");
            

    
            
           foreach($comments as $comment) : ?>
                <?php 
                
                $sql->execute([$comment['id']]);
                $reply_num = $sql->rowCount();

                $replies = $sql->fetchAll(PDO::FETCH_ASSOC); ?>

                <?php echo "
                <div>
                    <div class='comment'>
                        <img src='assets/img/avatar.png' class='rounded-circle mr-3' style='width: 30px;'>
                            <div class='bg-white p-3 rounded'>
                                <div class='user-name'><h6><b>".$comment['user_name']."</b></h6> <span class='time'>".$comment['created_at']."</span></div>
                                <div class='user-comment'>".$comment['comment']."</div>
                                <div>
                                   <div id='reply' class='text-primary my-4'> Reply </div>
                                    <form id='reply-form'>
                                        <input type='text' id='reply-username' class='form-control w-75' placeholder='Enter your name' />
                                        <textarea col='150' row='3' class='my-3 form-control' id='reply-content' placehoder='enter your reply'>".$comment['user_name']."... </textarea>
                                        <br>
                                        <button id='reply-btn' style='float: right;' class='btn btn-primary mb-3' >Post</button>
                                        <button id='comment_id' value='".$comment['id']."'></button>
                                    </form>
                                </div>
                                <span class='mb-5 mt-3 text-primary' id='num-reply'>".$reply_num." replies </span>
                            </div>
                    </div>"?>
                    <div id="comment-reply" > 
                        
                        <?php foreach($replies as $reply) : ?>
                            <?php echo "
                            <div class='replies ml-5'>
                                <div class='comment'>
                                    <img src='assets/img/avatar.png' class='rounded-circle mr-3' style='width: 30px;'>
                                    <div class='bg-white p-3 rounded'>
                                        <div class='user-name'><h6><b>".$reply['username']."</b></h6> <span class='time'>".$reply['created_at']."</span></div>
                                        <div class='user-comment'>".$reply['reply']."</div>
                                    </div>
                                </div>
                            </div>" ?>
                        <?php endforeach ?>
                    </div>
               <?php echo" </div>" ?>
                
            <?php endforeach ?>

    <?php } ?>







<?php

    //regiter replies
    function registerReplies($comment_id, $username, $reply){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO replies (comment_id, username, reply) 
        VALUES (?, ?, ?);");
        $stmt->execute([$comment_id, $username, $reply]);

        $sql = $conn->prepare("SELECT * FROM replies WHERE comment_id = ?");
        $sql->execute([$comment_id]);
        $replies = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($replies as $reply){
            echo "
            <div class='replies ml-5'>
                <div class='comment'>
                    <img src='assets/img/avatar.png' class='rounded-circle mr-3' style='width: 30px;'>
                    <div class='bg-white p-3 rounded'>
                        <div class='user-name'><h6><b>".$reply['username']."</b></h6> <span class='time'>".$reply['created_at']."</span></div>
                        <div class='user-comment'>".$reply['reply']."</div>
                    </div>
                </div>
            </div>" ;
        }
        
    }

    //get replies
    function getRepliesCount($comment_id){
        global $conn;
        $sql = $conn->prepare("SELECT * FROM replies WHERE comment_id = ?");
        $sql->execute([$comment_id]);
        $replies_count = $sql->rowCount();
        
        return $replies_count;
   
    }


    //register likes 
    function registerLikes($post_id, $user_ip){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM likes WHERE post_id = ? AND user_ip = ?");
        $stmt->execute([$post_id, $user_ip]);
        $result = $stmt->rowCount();
        if($result){
            $sql = $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_ip = ?");
            $sql->execute([$post_id, $user_ip]);
        }else{
            $sql = $conn->prepare("INSERT INTO likes (post_id, user_ip) VALUES (?, ?)");
            $sql->execute([$post_id, $user_ip]);
        }

        $sql = $conn->prepare("SELECT * FROM likes WHERE post_id = ?");
        $sql->execute([$post_id]);
        $likes = $sql->rowCount();
        return $likes;
    }


    //get page likes
    function getLikes($post_id){
        global $conn;
        $sql = $conn->prepare("SELECT * FROM likes WHERE post_id = ?");
        $sql->execute([$post_id]);
        $likes = $sql->rowCount();
        return $likes;
    }


    //get All time comments
    function getAllComments(){
        global $conn;
        $sql = $conn->prepare("SELECT * FROM comments");
        $sql->execute();
        $result = $sql->rowCount();
        return $result;
    }


    //get users total comment
    function usersTotalComment($users_id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM  comments WHERE author_id = ?");
        $stmt->execute(["$users_id"]);
        $result = $stmt->rowCount();
        return $result;
    }


    // Unscribe
    function unsubscribe($email){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM subscribers WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->rowCount();
        if($result <= 0){
            header("location: ./unsubscribe.php?notEmail");
            exit();
        }else{
            $stmt = $conn->prepare("DELETE FROM subscribers WHERE email = ?;");
            $stmt->execute([$email]);
            header("Location: unsubscribe.php?success");
        }
        

    }


    // Forgot Password
    function forgotPassword($email){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['email']){
            $title = "Password Reset";
            $user_email = $result['email'];
      
            
             // Sending notification to subscribers
             $mail = new PHPMailer(true);
            //  $mail->SMTPDebug = 2; 
             $mail->isSMTP();
             $mail->Host = "smtp-relay.sendinblue.com";
             $mail->SMTPAuth = "true";
             $mail->SMTPSecure = "tls";
             $mail->Port = "587";
             $mail->Username = "oluchi.web@gmail.com";
             $mail->Password = "xsmtpsib-4b851c7c225da14d3f6a257eade2adbc8deb42d61bab6091ee98f70e86f5d1a7-26NPVbLKwQsZq0Rk";
     
             $mail->isHTML(true);
             $mail->Subject = "TutaBlog: $title";
             $mail->setFrom("okorondukwe@outlook.com", "Tutablog");
             
             $mail->Body = "
             <p><b>Password Reset </b></p>
             <div>Hi <b>".$result['first_name']."</b></div>
             <p>Forgot password was initiated on your account, please ignore if you are not the one or 
               click the link below to reset your password
             </p>
             
                 <a  href='http://localhost/tutablog/reset-password.php?email=$user_email'>Reset password</a>
                
                 <br>
                 <br>
             <b>Best Regards </b> 
             Oluchi Cassidy for tutablog'
         </div>";
             $mail->addAddress($result['email']);
             $mail->send();
             
             if( $mail->send()){
                 header("Location: forgot-password.php?success");
                 exit();
                 }else{
                     header("Location: forgot-password.php?error");
                 }
 
            
        }else{
           header("location: forgot-password.php?success");
        }
        

                   
        
    }


    // Get Admin notifications
    function getNotifications($id){
        global $conn;
                $stmt = $conn->prepare("SELECT users.first_name, users.last_name, users.role, users.image, posts.title AS posts_title,
				notification.id,
                notification.destination_id, notification.source_id, notification.title, notification.message,
                notification.seen, notification.created_at
                FROM users 
                JOIN notification 
                ON users.id = notification.source_id
                JOIN posts 
                ON posts.id = notification.post_id
                WHERE notification.destination_id = ?
                ORDER BY notification.seen ASC LIMIT 5"); 

        $stmt->execute([$id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $result){
            echo "<div class='messages'>
            <div class='noticon'>
                <span class='fa fa-envelope'></span>
            </div>
            <div>
                <a href='user-notification-page.php' class=' text-secondary d-block seen".strval($result['seen'])."'>".$result['title']."</a>
                <span class='seen".strval($result['seen'])." text-secondary'>".substr($result['message'], 0, 8)."....</span>
            </div>
          </div>
          <hr>";
        }
       
        
    }

    function getAllNote($user_id){
        global $conn;
        $sql = $conn->prepare("SELECT users.first_name, users.last_name, users.role, users.image, posts.title AS posts_title,
        notification.id,
        notification.destination_id, notification.source_id, notification.title, notification.message,
        notification.seen, notification.created_at
        FROM users 
        JOIN notification 
        ON users.id = notification.source_id
        JOIN posts 
        ON posts.id = notification.post_id
        WHERE notification.destination_id = ? 
        ORDER BY created_at DESC");
        $sql->execute([$user_id]);
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // function getAllNotifications($user_id){
    //     global $conn;
    //     $sql = $conn->prepare("SELECT users.first_name, users.last_name, users.role, users.image, posts.title AS posts_title,
    //     notification.id,
    //     notification.destination_id, notification.source_id, notification.title, notification.message,
    //     notification.seen, notification.created_at
    //     FROM users 
    //     JOIN notification 
    //     ON users.id = notification.source_id
    //     JOIN posts 
    //     ON posts.id = notification.post_id
    //     WHERE notification.destination_id = ?");
    //     $sql->execute([$user_id]);
    //     $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    //     foreach($results as $result){
    //         echo ' <div>
    //                     <div class="open-note p-2">
    //                         <span class="note-fs mx-2 text-secondary seen'.strval($result['seen']).'">
    //                         '.$result['first_name'].' '. $result['last_name'].'</span>
    //                         <span class="note-fs text-secondary seen'.strval($result['seen']).'">'.$result['title'].'
    //                         <span class="text-secondary mt-2" style="float: right;">'.$result['created_at'].'</span>
    //                     </div>
    //                     <div class="row mb-5 note-msg ">
    //                         <div class="col-sm-1">
    //                             <image id="notImg" src="'.$result['image'].'">
    //                         </div>
    //                         <div class="col-sm-10">
                                
    //                             <div>
    //                             <span class="note mx-2 text-secondary seen'.strval($result['seen']).'">'. $result['first_name'].' '.$result['last_name'].'</span>
    //                             <span class="text-secondary mt-2 seen'.strval($result['seen']).'">'.$result['message'].'</span>
                                
    //                             </div>
                                
    //                         </div>
    //                     </div>
    //         </div>
        
    //         <hr>';
    //     }
        
        
    // }

    // Count notification
    function countNotifications($id){
        global $conn;
        $stmt = $conn->prepare("SELECT users.first_name, users.last_name, users.role, users.image, 
                    notification.destination_id, notification.source_id, notification.title, notification.message,
                    notification.seen, notification.created_at
                    FROM users 
                    JOIN notification 
                    ON users.id = notification.source_id
                    WHERE notification.destination_id = ?
                    AND notification.seen = ?"); 

        $stmt->execute([$id, '0']);
        $result = $stmt->rowCount();
        return $result;
        
    }


    // Mark all notification as read
    function markAllAsRead($user_id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `notification` SET `seen` = ? WHERE destination_id = ?");
        $stmt->execute(['1', $user_id]);

        return 'seen1';
    }

    function markAsRead($user_id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `notification` SET `seen` = ? WHERE id = ?");
        $stmt->execute(['1', $user_id]);

        return 'seen1';
    }


    






      
       
    