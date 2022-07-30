<?php require_once 'blog-config.php' ?>
<?php require_once 'includes/Bank.php' ?>

<?php 
  $users = getAllusers();
  // print_r($users);

?>
<?php include_once 'admin/header.php' ?>
<title>Users</title>
<?php include_once 'admin/navbar.php' ?>
                  <h5 class="page-title my-4">Users</h5>

                  <div class="container-fluid">
                    <div class="row">
                       <div class="col-12 main-lay py-3">
                      

                        <table class="table">
                            <thead class="bg-secondary text-light">
                              <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($users as $user) : ?>

                                <tr>
                                  <th scope="row"><?php echo $user['id'] ?></th>
                                  <td><img src="<?php echo $user['image'] ?>" style="height: 100px;"></td>
                                  <td><h5><?php echo $user['first_name']. " ". $user['last_name'] ?></h5></td>
                                  <td><h6><?php echo $user['role'] ?></h6></td>
                                </tr>

                              <?php endforeach ?>

                              

                              
                             
                            </tbody>
                          </table>
                       </div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>


