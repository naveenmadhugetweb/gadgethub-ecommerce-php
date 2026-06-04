<?php
session_start();

if ($_SESSION['role'] !== 'admin' || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

include '../config/database.php';
include '../includes/header.php';

$sql = "SELECT 
            products.*,
            brands.brand_name,
            categories.category_name
        FROM products
        JOIN brands 
        ON products.brand_id = brands.id
        JOIN categories 
        ON products.category_id = categories.id
        ORDER BY products.id DESC
";

$products = mysqli_query($conn, $sql);
?>

<style>
    body{
        background:#f4f7fb;
    }
    .dashboard-header{
        background: linear-gradient(135deg,#0d6efd,#0dcaf0);
        color:white;
        border-radius:15px;
        padding:25px;
    }
    .table-container{
        background:white;
        border-radius:15px;
        padding:20px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }
    .product-img{
        width:70px;
        height:70px;
        object-fit:cover;
        border-radius:10px;
    }
    .table th{
        background:#0d6efd;
        color:white;
        vertical-align:middle;
    }
    .table td{
        vertical-align:middle;
    }
    .badge-stock{
        font-size:13px;
        padding:7px 10px;
    }
    .action-btns a{
        margin-right:5px;
    }
</style>

<div class="container py-4">

    <!-- Dashboard Header -->
    <div class="dashboard-header mb-4 d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-speedometer2"></i>
                Admin Dashboard
            </h2>
            <div class="d-flex">
                <p class="mb-0">
                    Welcome,
                    <strong><?= $_SESSION['user_name']; ?></strong>
                    (<?= $_SESSION['role']; ?>)
                </p>
                <span class="nav-link px-3" href="#" id="adminprofile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-user fs-5"></i></span>
                <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button> -->
            </div>
        </div>
        <a href="category/add-category.php" class="btn btn-light btn-lg mt-3 mt-md-0">
            <i class="bi bi-plus-circle"></i>
            Add Category and Brand
        </a>
        <a href="add-product.php" class="btn btn-light btn-lg mt-3 mt-md-0">
            <i class="bi bi-plus-circle"></i>
            Add Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="table-container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; ?>
                </div>
            <?php unset($_SESSION['error']); endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; ?>
                </div>
            <?php unset($_SESSION['success']); endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                Products List
            </h4>
            <span class="badge bg-primary">
                Total Products:
                <?= mysqli_num_rows($products); ?>
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th width="170">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($products)) { ?>
                    <tr>
                        <td>
                            #<?= $row['id']; ?>
                        </td>
                        <td>
                            <img 
                                src="../uploads/<?= $row['image']; ?>" 
                                class="product-img"
                                alt=""
                            >
                        </td>
                        <td>
                            <strong>
                                <?= $row['product_name']; ?>
                            </strong>
                        </td>
                        <td>
                            <?= $row['brand_name']; ?>
                        </td>
                        <td>
                            <?= $row['category_name']; ?>
                        </td>
                        <td>
                            ₹<?= number_format($row['price']); ?>
                        </td>
                        <td>
                            <?php if($row['discount_price']) { ?>
                                <span class="text-success fw-bold">
                                    ₹<?= number_format($row['discount_price']); ?>
                                </span>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                        <td>
                            <?= $row['quantity']; ?>
                        </td>
                        <td>
                            <?php if($row['status'] == 1) { ?>
                                <span class="badge bg-success badge-stock">
                                    Active
                                </span>
                            <?php } else { ?>
                                <span class="badge bg-danger badge-stock">
                                    Inactive
                                </span>
                            <?php } ?>
                        </td>
                        <td class="action-btns">
                            <a 
                                href="edit-product.php?id=<?= $row['id']; ?>" 
                                class="btn btn-warning btn-sm"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a 
                                href="delete-product.php?id=<?= $row['id']; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are You sure Delete this product?')"
                            >
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end"  id="offcanvasRight">
  <div class="offcanvas-header">
    <h5>Admin Profile Options</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">   
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action fw-semibold">
            <i class="bi bi-bag text-warning me-2"></i>Feature1
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <i class="bi bi-heart me-2"></i>Feature2
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <i class="bi bi-gear me-2"></i>Feature3
        </a>
        <form action="/GADGETHUB/auth/logout.php?logout=success"  method="post" class="p-2 list-group-item list-group-item-action">
            <button type="submit" class="border-0 bg-transparent text-start w-100" style="background-color:noen;"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
        </form>
    </div>
  </div>
</div>
<!-- Custom JS -->
<script src="/GadgetHub/assets/js/validation.js"></script> 
<!-- custom js Must be end of the html docs.-->
<!-- WHY: If header in included file then some elements will readed before html docs loaded -->
