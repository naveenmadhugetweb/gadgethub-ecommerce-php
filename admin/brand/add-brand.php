<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/admin_functions.php';

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
                    <form method="POST" action="add-brand.php">

                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand Logo</label>
                            <input type="file" name="logo" class="form-control" required>
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
