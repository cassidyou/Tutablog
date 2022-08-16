</head>
<style>
    button{
        color: transparent;
        border-color: transparent;
        background-color: transparent;
    }
    .seen0{
        font-weight: 1000;
        color: black!important;
    }
    .seen1{
        font-weight: lighter!important;
        
    }
    #mark-read{
        float: right;
        cursor: pointer;
        margin-bottom: 8px;
        display: block;
    }
</style>





    
    <body>
        <div id="layout">
            <div class="side-menu ">
                <h4>TutaBlog</h4>
                <div class="close">
                    <span class="fa fa-times close"></span>
                </div>
                <?php if(isset($_SESSION['role'])) : ?>
                    <?php if($_SESSION['role'] == "Admin"){ ?>
                        <ul>
                            <li><a href="admin-dashboard.php"> Dashboard</a></li>
                            <li><a href="admin-manage-post.php">Manage Post</a> </li>
                            <li><a href="admin-blog-post.php">Blog Post</a> </li>
                            <li><a href="admin-create-post.php">Create Post</a> </li>
                            <li><a href="admin-create-category.php">Create Category</a> </li>
                            <li><a href="admin-create-watermark.php">Update Watermark</a></li>
                            <li><a href="users.php">All Users</a> </li>
                            <li><a href="admin-register-user.php">Register user</a></li>
                        </ul>
                    <?php }else{ ?>
                        <ul>
                            <li><a href="admin-dashboard.php"> Dashboard</a></li>
                            <li><a href="admin-manage-post.php">Manage Post</a> </li>
                            <li><a href="admin-blog-post.php">Blog Post</a> </li>
                            <li><a href="admin-create-post.php">Create Post</a> </li>
                            <li><a href="index.php">Visit Blog</a> </li>
                            
                            
                            
                        </ul>
                    <?php } ?>
    
                <?php endif ?>



               
            </div>
            <div id="panel" >
        <!---------------------------------------------- navbar ------------------------------->
               <div class="container-fluid">
                <div class="row">
                    <div class="col-12 w-auto">
                        <nav class="admin-navbar">
                            <div class="menu-search">
                                <div class="menu-icon">
                                    <span class="fa fa-bars"></span>
                                </div> 
                                 <form class="mx-5 d-none d-md-block">
                                    <input type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" class="search-input"/>
                                </form>
                            </div>
    
    
                        <ul class="admin-navbar-nav">
                        <li class="mx-4 msg li-card-l" title="Notification">
                            <span title="Notification" class="fa fa-bell "></span>
                            <span class=" bg-success unseen" id="unseen"></span>
                            <div class="card nav-card nav-card-l">
                                <div class="card-header">
                                    <h5><b>Notifications</b> </h5>
                                </div>
                                <div class="card-body" id="notification">
                                  
                                </div>
                                <div class="card-footer text-center">
                                    <a href="user-notification-page.php"<?php echo $_SESSION['id'] ?>>See all Notifications</a>
                                </div>
                            </div>
                        </li>
                      
                        <li class="li-with-card li-card-r">
                        <?php if(isset($_SESSION['image'])) : ?>
                           <?php echo "<img src=uploads/".$_SESSION['image']." class='img-fluid admin-img'>" ?>
                        <?php endif ?>

                            
                            <div class="card nav-card nav-card-r">
                                <div class="card-body">
                                   <div>
                                    <div><a href="user-profile.php"><span class="fa fa-user"></span>&nbsp; Profile</a></div>
                                    <br>
                                    <div><a href="user-setting.php"><span class="fa fa-cog"></span>&nbsp; Setting</a></div>
                                   
                                   </div>
                                </div>
                                <div class="card-footer">
                                    <a href=includes/logout.php class="btn btn-warning text-light"><span class="fa fa-sign-out-alt"></span> &nbsp; Logout</a>
                                </div>
                            </div>
                        </li>
                        <?php if(isset($_SESSION['username'])) : ?>
                            <span class="admin-name"><?php echo $_SESSION['username'] ?></span>
                        <?php endif ?>

                        </ul>   
                    </nav>
                    </div>
                    <div class="col-12 mt-5 pt-5">


                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") : ?>
                         <!-- echo $_SESSION['id'];  -->
                         <button id='user_id' value="<?php echo $_SESSION['id'] ?>"></button>
                        <script>
                                user_id = document.getElementById('user_id').value;
                                // console.log("your id is: " + user_id)


                                getNotificationCount(user_id);
                                getNotification(user_id);
                         
                                function getNotificationCount(userID){
                                
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?q=" + userID, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("unseen").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();
                                }


                                function getNotification(userID){
                                
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?r=" + userID, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("notification").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();
                                }

                                // 
                                setInterval(() => {
                                    user_id = document.getElementById('user_id').value;
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?r=" + user_id, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("notification").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();

                                }, 1000);

                                setInterval(() => {
                                    user_id = document.getElementById('user_id').value;
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?q=" + user_id, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("unseen").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();
                
                                }, 1000);


                        
                        </script>

                         
                    <?php endif ?>

                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Author") : ?>
                        <!-- echo $_SESSION['id'];  -->
                       <button id='user_id' value="<?php echo $_SESSION['id'] ?>"></button>



                        <script>
                                user_id = document.getElementById('user_id').value;
                                console.log("your id is: " + user_id);

                                getNotificationCount(user_id);
                                getNotification(user_id);
                         
                                function getNotificationCount(userID){
                                
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?q=" + userID, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("unseen").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();
                                }

                                function getNotification(userID){
                                
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "./includes/notification.php?r=" + userID, true);

                                xmlhttp.onload = function(){
                                if(this.readyState == 4 && this.status == 200){
                                    document.getElementById("notification").innerHTML = this.responseText;
                                }else{
                                    alert("Error: " + xmlhttp.status);
                                    alert("Error: " + xmlhttp.statusText);
                                }
                                };
                                xmlhttp.send();
                            }


                            setInterval(() => {
                                    user_id = document.getElementById('user_id').value;
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?r=" + user_id, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("notification").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();

                                }, 1000);

                                setInterval(() => {
                                    user_id = document.getElementById('user_id').value;
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.open("GET", "./includes/notification.php?q=" + user_id, true);

                                    xmlhttp.onload = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        document.getElementById("unseen").innerHTML = this.responseText;
                                    }else{
                                        alert("Error: " + xmlhttp.status);
                                        alert("Error: " + xmlhttp.statusText);
                                    }
                                    };
                                    xmlhttp.send();
                
                                }, 1000);

                        
                        </script>

                        
                   <?php endif ?>





                    