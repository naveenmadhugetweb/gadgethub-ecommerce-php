<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/admin_functions.php';

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
                        <a href="../dashboard.php" class="btn btn-secondary">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
