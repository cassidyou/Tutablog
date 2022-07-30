<?php include_once 'admin/header.php' ?>

<?php 
$error = '';
$message = '';

if (isset($_POST['submit'])){
    $category = cleanInput($_POST['category']);
    $slug = slugify($category);

    if(empty($category)){
        $error = "Please enter category name that you want to create!";
    }else{
        $stmt = $conn->prepare("SELECT * FROM category WHERE category_name = ?");
        $stmt->execute([$category]);
        $category_name = $stmt->fetch();
        if($category_name){
            $error = "Category you are trying to create already exists";
        }else{
            $stmt = $conn->prepare('INSERT INTO category (category_name, slug) VALUES (?, ?);');
            $stmt->execute([$category, $slug]);

            header("Location: ./admin-create-category.php?success");
        }


       
    }
}


?>


<title>Create Category</title>
<?php include_once 'admin/navbar.php' ?>

                  <div class="container">
                    <div class="row">
                       <div class="col-12 main-lay py-3 px-5">
                            <h4 class="my-4 mb-5">Create Category</h4>
                            <div class="row">
                                <div class="col-12">
                                    <form action="" method="POST">
                                                <?php 
                                                    if(isset($_GET['success'])){
                                                        $message = $_GET['success'];
                                                        $message = "Category is successfully created";
                                                        echo '<span class="alert alert-success my-2">'.$message .'</span>';
                                                    }
                                                ?>
                                                <?php 
                                                    if(isset($_POST['submit'])){
                                                        echo '<span class="alert alert-danger my-2">'.$error .'</span>'; 
                                                    }
                                                ?>
                                            <div class="my-5">
                                                   
                                               
                                                <h6 class="text-secondary"><b>Category Name</b></h6>
                                                <input type="text" name="category"  placeholder="Enter category here" class="form-control">
                                            </div>
                                        <div class="text-center">
                                            <input type="submit" name="submit"  onclick="return confirm('You are about to create a category?');" value="Create category" class="btn btn-success mt-4 submit">
                                        </div>
                                    </form>
                                </div>
                            </div>         
                       </div>
                    </div>
                  </div>

<?php include_once 'admin/footer.php' ?>

