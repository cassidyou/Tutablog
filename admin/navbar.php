</head>






    
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
                            <li><a href="users.php">All Users</a> </li>
                            <li><a href="admin-register-user.php">Register user</a> </li>
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
                        <li class="mx-4 msg li-card-l">
                            <span title="Notification" class="fa fa-bell "></span>
                            <span class=" bg-success unseen">4</span>
                            <div class="card nav-card nav-card-l">
                                <div class="card-header">
                                    <h5><b>Notifications</b> </h5>
                                    <h6>Clear All</h6>
                                </div>
                                <div class="card-body">
                                  <div class="messages">
                                    <div class="noticon">
                                        <span class="fa fa-cog"></span>
                                    </div>
                                    <div>
                                        <span class="d-block"><b>New settings</b></span>
                                        <span>There are new setting</span>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">See all Notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="mr-4 msg li-card-c">
                            <span title="Messages" class="fa fa-envelope "></span>
                            <span class=" bg-danger unseen">16</span>
    
                            <div class="card nav-card nav-card-c">
                                <div class="card-header">
                                    <h5><b>Messages</b> </h5>
                                    <h6>Clear All</h6>
                                </div>
                                <div class="card-body">                                
                                  <div class="messages">
                                    <div>
                                        <img src="assets/img/interns-img/Nwafili Vincent Chinonso.jpeg" class="msg-img">
                                    </div>
                                    <div>
                                        <span class="d-block"><b>Daniel</b></span>
                                        <span>Nice meeting you....</span>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">See all Messages</a>
                                </div>
                            </div>
    
                        </li>
                        <li class="li-with-card li-card-r">
                        <?php if(isset($_SESSION['image'])) : ?>
                             <img src=<?php echo $_SESSION['image'] ?> class="img-fluid admin-img">

                        <?php endif ?>

                            
                            <div class="card nav-card nav-card-r">
                                <div class="card-body">
                                   <div>
                                    <div><a href=""><span class="fa fa-user"></span>&nbsp; Profile</a></div>
                                    <br>
                                    <div><a href=""><span class="fa fa-cog"></span>&nbsp; Setting</a></div>
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