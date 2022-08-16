<?php include_once 'admin/header.php' ?>

<?php  
$errors = [];

$user = getUserById($_SESSION['id']);
include_once 'includes/edit-user.php';  
?>

<title>Setting</title>
<?php include_once 'admin/navbar.php' ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-sm-3"></div>
                       <div class="col-sm-6 main-lay py-3 px-5">
                        <h4 class="my-4 mb-5">Settings</h4>
                        <?php if(isset($_GET['wrong'])) : ?>
                            <div class="alert alert-danger">Your password is incorrect</div>
                        <?php endif?>
                        <?php if (!empty($errors)): ?>
                            
                            <?php foreach($errors as $error): ?>
                                <div class="alert alert-danger"><?php echo $error ?></div>
                            <?php endforeach; ?>
                            
                        <?php endif; ?>
                       
                       <div class="row">
                        <div class="col-12">
                            <form method="POST" enctype="multipart/form-data">
                                <div>
                                <?php if(isset($_GET['success'])){

                                    echo "<div class='alert alert-success'>Your profile is updated successfully </span>";
                                    }
                                    ?>
                                </div>

                                    <div class="text-center">
                                    <?php echo "<img src=uploads/".$user['image']." class='w-25 rounded text-center'>" ?>
                                    </div>
                                
                                    <div>
                                        <h6 class="text-secondary mt-5">Change profile picture</h6>
                                        <input type="file"  name="image" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Change firstname</h6>
                                        <input type="text" name="firstname" value="<?php echo $user['first_name'] ?>"  placeholder="Enter firstname" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Change lastname</h6>
                                        <input type="text" name="lastname" value="<?php echo $user['last_name'] ?>" placeholder="Enter lastname" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Change username</h6>
                                        <input type="text" name="username" value="<?php echo $user['username'] ?>" placeholder="Enter user" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Change email</h6>
                                        <input type="text" name="email" value="<?php echo $user['email'] ?>" placeholder="Enter email" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h4>Change password</h4>
                                        <h6 class="text-secondary">New password</h6>
                                        <input type="password" name="new_password" placeholder="Enter new password" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Confirm new password</h6>
                                        <input type="password" name="confirm_password" placeholder="Confrim password" class="form-control">
                                    </div>
                                    <h5>Please enter your password to save changes </h5>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Enter your Password</h6>
                                        <input type="password" name="password" placeholder="Enter your current password" class="form-control">
                                    </div>
          
                                <div class="text-center">
                                    <input id="submit" type="submit" name="submit" value="Save changes" class="btn btn-success mt-4" onclick="return confirm('You are about to save changes made to your profile?');">
                                </div> 
                            </form>

                        </div>
                       </div>
                       </div>
                       <div class="col-sm-3"></div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>

