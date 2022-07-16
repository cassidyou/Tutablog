<?php include_once "admin/header.php" ?>
<?php include_once "admin/navbar.php" ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-12 main-lay py-3 px-5">
                        <h4 class="my-4 mb-5">Update Post</h4>

                       <div class="row">
                        <div class="col-12">
                            <form action="">

                                
                                    <div>
                                        <h6 class="text-secondary">Post Image</h6>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="my-5">
                                        <h6 class="text-secondary">Post Title</h6>
                                        <input type="text" name="title" placeholder="Enter post title" class="form-control">
                                    </div>
                               
                               
                                <h6 class="text-secondary mt-5">Post content/Description</h6>
                                <textarea name="post_content"cols="30" rows="20" class="form-control mb-5"></textarea>

                               
                                <div class="row">
                                    <div class="col-md-6 my-3">
                                        <h6 class="text-secondary">Category</h6>
                                        <select name="category" class="form-control">
                                            <option value="">Choose....</option>
                                            <option value="Airospace">Airospace</option>
                                            <option value="Education">Education</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Lifestyl">Lifestyle</option>
                                            <option value="Travel">Travel</option>
                                            <option value="Fashion">Fashion</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <h6 class="text-secondary">Author</h6>
                                        <select name="author" class="form-control">
                                            <option value="">Choose....</option>
                                            <option value="Brad Traversy">Brad Traversy</option>
                                            <option value="John Doe">John Doe</option>
                                            <option value="Omaka Samuel">Omaka Samuel</option>
                                            <option value="Online Doctor">Online Doctor</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="text-center">
                                    <input type="submit" name="submit" value="Save Update" class="btn btn-success mt-4">
                                </div>

                               
                               
                               
                                
                            </form>

                        </div>
                       </div>

                      
                       </div>
                      </div>
                  </div>
<?php include_once "admin/footer.php" ?>



                 