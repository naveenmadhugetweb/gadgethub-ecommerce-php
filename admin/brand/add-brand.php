<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/admin_functions.php';

$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = mysqli_query($conn, $categoriesQuery);

if (isset($_POST['add_brand'])) {

    addBrand();
}

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Add Brand</h4>
                </div>
                <div class="card-body">

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; ?>
                        </div>
                    <?php unset($_SESSION['error']); endif; ?>
                    <form method="POST" action="add-brand.php" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Select Category</label>
                            <!-- <input type="text" name="name" class="form-control" required> -->
                            <select id="category" class="form-control" name="categoryId">
                                <option value="">Select Category</option>
                                <?php while($category = mysqli_fetch_assoc($categoriesResult)) { ?>
                                    <option value="<?= $category['id'] ?>">
                                        <?= $category['category_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand Logo</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country Of Brand</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                        <button type="submit" name="add_brand" class="btn btn-success">
                            Add Brand
                        </button>
                        <a href="../category/add-category.php" class="btn btn-secondary">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
