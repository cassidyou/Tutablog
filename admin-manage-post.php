<?php include_once 'admin/header.php' ?>
<title>Manage Post</title>
<?php include_once 'admin/navbar.php' ?>

                  <h5 class="page-title my-4">Posts</h5>
                  <div class="container-fluid">
                    <div class="row">
                       <div class="col-12 main-lay py-3">
                        <h4>Posts</h4>

                        <div class="table-container">
                            <table class="table .table-hover">
                                <thead class="bg-secondary text-light">
                                  <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><img src="assets/img/interns-img/Marvellous Elochukwu.jpeg" style="height: 50px;"></td>
                                    <td><p>How Water is Good for Health</p></td>
                                    <td><p>Brad</p></td>
                                    <td>Health</td>
                                    <td><div class="action">
                                        <a href="updatePost.html" class="btn btn-primary">Update</a>
                                        <a href="" class="btn btn-success">Publish</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </div></td>
                                  </tr>
                                 
                                </tbody>
                              </table>
                        </div>
                       </div>
                      </div>
                  </div>

<?php include_once 'admin/footer.php' ?>