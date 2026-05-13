<?php 

session_start();

include '../../includes/header.php';
include '../../includes/admin_functions.php';

    $brandsQuery = "SELECT * FROM brands";
    $brandResult = mysqli_query($conn, $brandsQuery);

    $product =  $_SESSION['product'];
    $smartphonData = $_SESSION['smartphonData'];

    // var_dump("hi", $product , $smartphonData);exit;

if($_SERVER["REQUEST_METHOD"] == "POST") {
        // print_r("hi");exit;
        editSmartphon();
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
                    <input type="text" name="name" class="form-control" value="<?= $product['product_name'] ?>"  required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Discount Price</label>
                    <input type="number" name="dprice" class="form-control" value="<?= $product['discount_price'] ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required> <?= $product['description'] ?></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <input type="text" name="category" value="Smartphones" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Brand Name (Dont change it)</label>
                    <select id="category" class="form-control" name="brandId">
                        <option value="">Select Category</option>
                        <?php while($brand = mysqli_fetch_assoc($brandResult)) { ?>
                            <option value="<?= $brand['id'] ?>" <?= ($brand['id'] == $product['brand_id']) ? 'selected' : '' ?>>
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
                    <input type="number" name="quantity" class="form-control" value="<?= $product['quantity'] ?>" required>
                </div>
                <hr class="my-4">
                <h4 class="mb-3">Smart Phones Specifications</h4>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" class="form-control" value="<?= $smartphonData['name'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RAM</label>
                        <select name="ram" class="form-select">
                            <option value="">Select RAM</option>
                            <option <?= ($smartphonData['ram'] == '4 GB') ? 'selected' : '' ?>>4 GB</option>
                            <option <?= ($smartphonData['ram'] == '6 GB') ? 'selected' : '' ?>>6 GB</option>
                            <option <?= ($smartphonData['ram'] == '8 GB') ? 'selected' : '' ?>>8 GB</option>
                            <option <?= ($smartphonData['ram'] == '12 GB') ? 'selected' : '' ?>>12 GB</option>
                            <option <?= ($smartphonData['ram'] == '16 GB') ? 'selected' : '' ?>>16 GB</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Storage</label>
                        <select name="storage" class="form-select">
                            <option value="">Select Storage</option>
                            <option <?= ($smartphonData['storage'] == '64 GB') ? 'selected' : '' ?>>64 GB</option>
                            <option <?= ($smartphonData['storage'] == '128 GB') ? 'selected' : '' ?>>128 GB</option>
                            <option <?= ($smartphonData['storage'] == '256 GB') ? 'selected' : '' ?>>256 GB</option>
                            <option <?= ($smartphonData['storage'] == '512 GB') ? 'selected' : '' ?>>512 GB</option>
                            <option <?= ($smartphonData['storage'] == '1 TB') ? 'selected' : '' ?>>1 TB</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Processor</label>
                        <input type="text" name="processor" class="form-control" value="<?= $smartphonData['processor'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Front Camera</label>
                        <input type="text" name="camera_front_mp" class="form-control" placeholder="32 MP" value="<?= $smartphonData['camera_front_mp'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rear Camera</label>
                        <input type="text" name="camera_rear_mp" class="form-control" placeholder="108 MP" value="<?= $smartphonData['camera_rear_mp'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Battery</label>
                        <input type="text" name="battery" class="form-control" placeholder="5000 mAh" value="<?= $smartphonData['battery'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Size</label>
                        <input type="text" name="display_size" class="form-control" placeholder="6.7 inch" value="<?= $smartphonData['display_size'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Operating System</label>
                        <select name="operating_system" class="form-select">
                            <option value="">Select OS</option>
                            <option  <?= ($smartphonData['operating_system'] == 'Android') ? 'selected' : '' ?> >Android</option>
                            <option  <?= ($smartphonData['operating_system'] == 'iOS') ? 'selected' : '' ?> >iOS</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" value="<?= $smartphonData['color'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warranty</label>
                        <select name="warranty" class="form-select">
                            <option value="">Select Warranty</option>
                            <option <?= ($smartphonData['warranty'] == '6 Months') ? 'selected' : '' ?>>6 Months</option>
                            <option <?= ($smartphonData['warranty'] == '1 Year') ? 'selected' : '' ?>>1 Year</option>
                            <option <?= ($smartphonData['warranty'] == '2 Years') ? 'selected' : '' ?>>2 Years</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Network Type</label>
                        <select name="network_type" class="form-select">
                            <option <?= ($smartphonData['network_type'] == '4G') ? 'selected' : '' ?>  >4G</option>
                            <option <?= ($smartphonData['network_type'] == '5G') ? 'selected' : '' ?> >5G</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SIM Type</label>
                        <select name="sim_type" class="form-select">
                            <option <?= ($smartphonData['sim_type'] == 'Single SIM') ? 'selected' : '' ?> >Single SIM</option>
                            <option <?= ($smartphonData['sim_type'] == 'Dual SIM') ? 'selected' : '' ?>>Dual SIM</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Refresh Rate</label>
                        <select name="refresh_rate" class="form-select">
                            <option <?= ($smartphonData['refresh_rate'] == '60 Hz') ? 'selected' : '' ?>>60 Hz</option>
                            <option <?= ($smartphonData['refresh_rate'] == '90 Hz') ? 'selected' : '' ?>>90 Hz</option>
                            <option <?= ($smartphonData['refresh_rate'] == '120 Hz') ? 'selected' : '' ?>>120 Hz</option>
                            <option <?= ($smartphonData['refresh_rate'] == '144 Hz') ? 'selected' : '' ?>>144 Hz</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fast Charging</label>
                        <select name="fast_charging" class="form-select">
                            <option <?= ($smartphonData['fast_charging'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                            <option <?= ($smartphonData['fast_charging'] == 'No') ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fingerprint Sensor</label>
                        <select class="form-control" name="fingerprint_sensor">
                            <option value="">Select Category</option>
                                <option <?= ($smartphonData['fingerprint_sensor'] == 'Yes') ? 'selected' : '' ?>> Yes</option>
                                <option <?= ($smartphonData['fingerprint_sensor'] == 'No') ? 'selected' : '' ?>> No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Launch Year</label>
                        <input type="year" name="launch_year" class="form-control" value="<?= $smartphonData['launch_year'] ?>">
                    </div>
                </div>

                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                <input type="hidden" name="brandId" value="<?= $product['brand_id'] ?>">
                <input type="hidden" name="categoryId" value="<?= $product['category_id'] ?>">


                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Update Smartphone
                    </button>
                    <a href="../add-product.php" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
