<?php 

include '../../includes/header.php';
include '../../includes/admin_functions.php';

$brandsQuery = "SELECT * FROM brands";
$brandResult = mysqli_query($conn, $brandsQuery);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // print_r();exit;
        addEarbuds();

    }

?>

<title>Add Product</title>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Add Earbuds Product</h2>
        <form method="POST" action="earbuds-details.php" enctype="multipart/form-data">
            <div class="row">
                <!-- PRODUCT INFO -->
                <div class="col-md-4 mb-3">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Discount Price</label>
                    <input type="number" name="dprice" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <input type="text" name="category" value="Earbuds" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <!-- <label>brand</label> -->
                    <label class="form-label">Select Brand Name</label>
                    <!-- <input type="text" name="name" class="form-control" required> -->
                        <select id="category" class="form-control" name="brandId">
                        <option value="">Select Category</option>
                        <?php while($brand = mysqli_fetch_assoc($brandResult)) { ?>
                            <option value="<?= $brand['id'] ?>">
                                <?= $brand['brand_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <hr class="my-4">
                <h4 class="mb-3">Earbuds Specifications</h4>
                <!-- EARBUD DETAILS -->
                <div class="col-md-6 mb-3">
                    <label>Battery Life</label>
                    <input type="text" name="battery_life" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Noise Control</label>
                    <input type="text" name="noise_control" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Bluetooth Version</label>
                    <input type="text" name="bluetooth_version" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Water Resistant</label>
                    <input type="text" name="water_resistant" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Warranty</label>
                    <input type="text" name="warranty" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" required>
                </div>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">
                Add Product
            </button>
            <a href="../add-product.php" class="btn btn-secondary">
                Back
            </a>
        </form>
    </div>
</div>
