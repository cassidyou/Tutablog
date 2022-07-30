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

    $conn = db_connect("localhost","blogproject","root","");

    //Fetch all published post
    function getPublishedPosts(){
        global $conn;
        $stmt = $conn->prepare('SELECT  posts.*, category.id AS category_id, category.category_name
        FROM posts 
        JOIN post_category
        ON posts.id = post_category.post_id
        JOIN category 
        ON post_category.category_id = category.id
        WHERE posts.published = ?
        ORDER BY posts.id DESC');
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
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? OR email = ?;');

        $stmt->execute([$username, $username]);

        if($stmt->rowCount() == 0){
            header("Location: ./user-login.php?notfound");
            exit();
        }

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($user);
            $user_password =  $user['password'];
            $check_pwd = password_verify($password, $user_password);
            if($check_pwd == true){

                
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['image'] = $user['image'];
                $_SESSION['id'] = $user['id'];

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
            post_category.category_id AS category_id, users.first_name, users.last_name
            FROM users
            JOIN posts 
            ON users.id = posts.user_id 
            JOIN views
            ON posts.id = views.post_id
            JOIN post_category
            ON posts.id = post_category.post_id
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



    // get all comments by post
    function getComments($post_id){
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY id DESC ");
            $stmt->execute([$post_id]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($comments as $comment){
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
            }

    }








      
       
    