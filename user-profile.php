<?php include_once 'admin/header.php' ?>

<?php 
$user = getUserById($_SESSION['id']);
?>


<title>Profile page</title>
<?php include_once 'admin/navbar.php';  ?>
<style>
    .profile-pic{
        height: 70%!important;
        border: 5px solid white;
        border-radius: 10px;
        
    }
.bg{
    background: #364046;
}
    .details .col-8{
        font-weight: bold;
    }

    @media screen and (max-width: 420px) {
         .details .col-4, .details .col-8{
        font-size: .9rem;
    }
    }
   
</style>


                
    
    

        <div class="container">
            <div class="row ">
                <div class="col-sm-2 col-md-3 col-lg-4"></div>
                <div class="col-sm-8 col-md-6 col-lg-4 bg rounded text-light px-4 pb-5 details" style="word-break: break-word;">
                    <div class="mt-3 mb-5">
                        <span class="page-title my-4">Your Profile</span>
                        <a href="user-setting.php" style="float: right;" class="btn bg-light text-primary">Edit profile</a>
                    </div>
                    
                    <div class="row align-items-center justify-content-center my-5">
                        <div class="col-8 text-center">
                            <?php echo "<img src=uploads/".$user['image']." class='img-fluid profile-pic'>" ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-4 text-right">Firstname</div>
                        <div class="col-8 text-left"> <?php echo $user['first_name'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Lastname</div>
                        <div class="col-8 text-left"> <?php echo $user['last_name'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Gender</div>
                        <div class="col-8 text-left"> <?php echo $user['gender'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Username</div>
                        <div class="col-8 text-left"> <?php echo $user['username'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Email</div>
                        <div class="col-8 text-left"> <?php echo $user['email'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Role</div>
                        <div class="col-8 text-left"> <?php echo $user['role'] ?></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-4 text-right">Joined</div>
                        <div class="col-8 text-left"> <?php echo $user['created_at'] ?></div>
                    </div>
                   
                </div>
                <div class="col-sm-2 col-md-3 col-lg-4"></div>
            </div>
        </div>

             


<?php include_once 'admin/footer.php' ?>
