<?php
session_start();

include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/admin_functions.php';


if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

if (isset($_POST['add_category'])) {

    addCategory();

}

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success']; ?>
                        </div>
                    <?php unset($_SESSION['success']); endif; ?>

                    <form method="POST" action="add-category.php">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <button type="submit" name="add_category" class="btn btn-success">
                            Add Category
                        </button>                        
                        <a href="../brand/add-brand.php"class="btn btn-success">
                            Add brand
                        </a>
                        <a href="../dashboard.php" class="btn btn-secondary">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
