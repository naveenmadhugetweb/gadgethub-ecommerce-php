<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

include '../config/database.php';
include '../includes/header.php';


$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

if (isset($_POST['add_product'])) {

    $id =  $_POST['categoryId'];
    if($id == null){
        $_SESSION['error'] = "Please select other options";
        header("Location: ../admin/add-product.php"); exit;
    }else{
        $sql = "SELECT category_name FROM categories WHERE id = $id";
        $categoryName = mysqli_query($conn, $sql);
        $categoryData = mysqli_fetch_assoc($categoryName);

        // var_dump( $categoryData['category_name']); exit;
        $cName =  $categoryData['category_name'];
        // var_dump("hi", $_POST, "hii", $_POST['categoryId']);exit;

        if($cName == 'Earbuds'){

            // $_SESSION['user_id'] = $userData['id'];
            // $_SESSION['user_name'] = $userData['name'];
            header("Location: ../admin/category/earbuds-details.php");exit;
        }elseif($cName == 'Smartphones'){
            var_dump("hi");exit;
        }
        elseif($cName == 'Laptops'){
           var_dump("hi");exit;
        }else{

            $_SESSION['error'] = "Please select other options";
            header("Location: ../admin/add-product.php"); exit;

        }
        header("Location: dashboard.php");
    }
}

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Give Product Detail</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="add-product.php">
                        <div class="mb-3"> 
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger">
                                    <?= $_SESSION['error']; ?>
                                </div>
                            <?php unset($_SESSION['error']); endif; ?>

                            <label class="form-label">Select Category Name</label>
                                <select id="category" class="form-control" name="categoryId">
                                <option value="">Select Category</option>
                                <?php while($category = mysqli_fetch_assoc($categoryResult)) { ?>
                                    <option value="<?= $category['id'] ?>">
                                        <?= $category['category_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label class="form-label text-warning"> Don't select Other options than Laptop, Smartphones, Earbuds</label>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-success">
                            Go to Add Product
                        </button>
                        <a href="../admin/dashboard.php" class="btn btn-secondary">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
