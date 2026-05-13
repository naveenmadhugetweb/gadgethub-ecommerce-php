<?php 

include '../../includes/header.php';
include '../../includes/admin_functions.php';

$brandsQuery = "SELECT * FROM brands";
$brandResult = mysqli_query($conn, $brandsQuery);

    if($_SERVER["REQUEST_METHOD"] == "POST") {        
        // print_r();exit;
        addSmartphones();
    }

?>

    <title>Smartphone Form</title>

    <div class="container mt-5 mb-5 p-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h3>Add Smartphone Details</h3>
        </div>
        <div class="card-body">
        <h2 class="mb-4">Add smartphone Product</h2>
        <form method="POST" action="add-smartphones-details.php" enctype="multipart/form-data">
            <div class="row">
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
                    <input type="text" name="category" value="Smartphones" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Brand Name</label>
                        <select id="category" class="form-control" name="brandId">
                        <option value="">Select Brand</option>
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
                <h4 class="mb-3">Smart Phones Specifications</h4>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RAM</label>
                        <select name="ram" class="form-select">
                            <option value="">Select RAM</option>
                            <option>4 GB</option>
                            <option>6 GB</option>
                            <option>8 GB</option>
                            <option>12 GB</option>
                            <option>16 GB</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Storage</label>
                        <select name="storage" class="form-select">
                            <option value="">Select Storage</option>
                            <option value="64 GB">64 GB</option>
                            <option value="128 GB">128 GB</option>
                            <option value="256 GB">256 GB</option>
                            <option value="512 GB">512 GB</option>
                            <option value="1 TB">1 TB</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Processor</label>
                        <input type="text" name="processor" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Front Camera</label>
                        <input type="text" name="camera_front_mp" class="form-control" placeholder="32 MP">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rear Camera</label>
                        <input type="text" name="camera_rear_mp" class="form-control" placeholder="108 MP">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Battery</label>
                        <input type="text" name="battery" class="form-control" placeholder="5000 mAh">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Size</label>
                        <input type="text" name="display_size" class="form-control" placeholder="6.7 inch">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Operating System</label>
                        <select name="operating_system" class="form-select">
                            <option value="">Select OS</option>
                            <option>Android</option>
                            <option>iOS</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warranty</label>
                        <select name="warranty" class="form-select">
                            <option value="">Select Warranty</option>
                            <option>6 Months</option>
                            <option>1 Year</option>
                            <option>2 Years</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Network Type</label>
                        <select name="network_type" class="form-select">
                            <option>4G</option>
                            <option>5G</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SIM Type</label>
                        <select name="sim_type" class="form-select">
                            <option>Single SIM</option>
                            <option>Dual SIM</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Refresh Rate</label>
                        <select name="refresh_rate" class="form-select">
                            <option>60 Hz</option>
                            <option>90 Hz</option>
                            <option>120 Hz</option>
                            <option>144 Hz</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fast Charging</label>
                        <select name="fast_charging" class="form-select">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fingerprint Sensor</label>
                        <select name="fingerprint_sensor" class="form-select">
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Launch Year</label>
                        <input type="year" name="launch_year" class="form-control">
                    </div>

                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Add Smartphone
                    </button>
                    <a href="../add-product.php" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
