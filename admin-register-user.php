<?php include_once 'admin/header.php' ?>

<?php 
   $first_name = '';
   $last_name = '';
   $user_name = '';
   $email = '';
   $successMsg = '';

   




include_once 'includes/register-user.php';

 
   
   
?>

<title>Register User</title>
<?php include_once 'admin/navbar.php' ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-sm-2"></div>
                       <div class="col-sm-8 main-lay py-3 px-5">
                        <h4 class="my-4 mb-5">Register User</h4>
                       <?php 
                              if(isset($_GET['success'])){
                                $successMsg = $_GET['success']; 
                                $successMsg = "User is successfully registered. "; 
                                echo "<div class='alert alert-success'>
                                $successMsg User login details has been sent to the registered email.
                                </div>";
                              
                                } 
                              if(isset($_GET['partial'])){
                                $partialMsg = $_GET['partial']; 
                                $partialMsg = "User is successfully registered. "; 
                                echo "<div class='alert alert-success'>$partialMsg</div>";

                                echo "<div class='alert alert-danger'>
                                Something went wrong! user login details was not sent to the registered email. 
                                </div>";
                              
                                } 
                       ?>
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <div><?php echo $error ?></div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                       <div class="row">
                        <div class="col-12">
                            <form action="" method="POST" enctype="multipart/form-data">

                                
                                    <div>
                                        <h6 class="text-secondary">Passport</h6>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Firstname</h6>
                                        <input type="text" name="firstname" value="<?php if(isset($_POST['submit'])){echo $_POST['firstname']; } ?>" placeholder="Enter firstname" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Lastname</h6>
                                        <input type="text" name="lastname" value="<?php if(isset($_POST['submit'])){echo $_POST['lastname']; } ?>" placeholder="Enter lastname" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Username</h6>
                                        <input type="text" name="username" value="<?php if(isset($_POST['submit'])){echo $_POST['username']; } ?>" placeholder="Enter user" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Email</h6>
                                        <input type="text" name="email" value="<?php if(isset($_POST['submit'])){echo $_POST['email']; }?>" placeholder="Enter email" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Gender</h6>
                                        <input type="radio" name="gender" class="" value="Male" checked> Male <span class="mr-4"></span>
                                        <input type="radio" name="gender" class="" value="Female"> Female 
                                    </div>



                               
                               
                                    <div class="my-3">
                                        <h6 class="text-secondary">Role</h6>
                                        <select name="role" class="form-control">
                                            <option value="">Choose....</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Author">Author</option>
                                            
                                        </select>
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Password</h6>
                                        <input type="password" name="password" placeholder="Enter password" class="form-control">
                                    </div>

                                    <div class="my-5">
                                        <h6 class="text-secondary">Password</h6>
                                        <input type="password" name="confirm_password" placeholder="Confrim password" class="form-control">
                                    </div>
          
                                <div class="text-center">
                                    <input type="submit" name="submit" value="Register" class="btn btn-success mt-4">
                                </div> 
                            </form>

                        </div>
                       </div>

                      
                       </div>
                       <div class="col-sm-2"></div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>