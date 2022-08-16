<?php require_once 'blog-config.php' ?>
<?php require_once 'includes/Bank.php' ?>

<?php 
  $users = getAllusers();
  // print_r($users);

?>
<?php include_once 'admin/header.php' ?>
<title>Users</title>
<style>
  .user-status0, 
  .active-1, 
  .inactive-0{
    background: gray!important;
    border: none;
    cursor: default!important;
    pointer-events: none!important;
  }


</style>
<?php include_once 'admin/navbar.php' ?>
                  <h5 class="page-title my-4">Users</h5>

                  <div class="container-fluid">
                    <div class="row">
                       <div class="col-12 main-lay py-3" style="overflow-x: scroll ;">
                      

                        <table class="table">
                            <thead class="bg-secondary text-light">
                              <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Last Login</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($users as $user) : ?>
                                <?php 
                                    $user_id = $user['id'];
                                    $date = date('M d, Y ', strtotime($user['created_at']));
                                    $last_login = date('M d, Y ', strtotime($user['last_login']));
                                ?>
                                
                                <tr>
                                  <th scope="row"><?php echo $user_id ?></th>
                                  <td><?php echo "<img src=uploads/".$user['image']." style='height: 100px';>" ?></td>
                                  <td><h5><?php echo $user['first_name']. " ". $user['last_name'] ?></h5></td>
                                  <td><h6><?php echo $user['role'] ?></h6></td>
                                  <td><h6>
                                    <span class="bg-success py-1 px-2 text-light rounded user-status<?php echo $user['active']?>">Active</span>
                                  </h6></td>
                                  <td><h6><?php echo $date ?></h6></td>
                                  <td><h6><?php echo $last_login ?></h6></td>
                                  <td>
                                    <?php if($user['role'] == 'Admin') : ?>
                                    
                                    <span>Admin can not be deactivated</span>
                                    
                                    <?php endif ?>

                                    <?php if($user['role'] == 'Author') : ?>
                                        <div class="row">
                                          <div class="col-5">
                                            <a href="includes/edit-user.php?deactivate=<?php echo $user_id ?>" onclick="return confirm('You are about to deactive this user?');" class="btn btn-danger text-light inactive-<?php echo $user['active']?>">
                                            Deactivate 
                                          </a></div>
                                          <div class="col-1"></div>
                                          <div class="col-5">
                                            <a href="includes/edit-user.php?activate=<?php echo $user_id ?>" onclick="return confirm('You are about to activate this user?');" class="btn btn-success text-light active-<?php echo $user['active']?>">
                                            Activate
                                          </a></div>
                                          
                                        </div>
                            
                                    <?php endif ?>


                                    
                                  </td>
                                </tr>

                              <?php endforeach ?>

                              

                              
                             
                            </tbody>
                          </table>
                       </div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>

<script>
 $(document).ready(function(){
  $(".user-status0").text("Deactivated");
 })
</script>
