<?php

include '../config/database.php';

$sql = "SELECT * FROM products";
/*                                      // use this when wan't also category and brand name from their tables 
$sql ="
SELECT 
    p.*,
    c.category_name,
    b.brand_name
FROM products p
JOIN categories c
    ON p.category_id = c.id
JOIN brands b
    ON p.brand_id = b.id
";
*/
$result = mysqli_query($conn, $sql);
// $products = mysqli_fetch_assoc($res);

/*
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['product_name'] . "<br>";
}
print_r($result);
function message() {
    return "PHP Function Called Successfully!";
}
echo message();
echo "
<div class='card'>
    <h2>Product Name</h2>
    <p>Price: ₹999</p>
</div>
";
*/
?>


<div class="row">

<?php while ($product = mysqli_fetch_assoc($result)) { ?>

    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

        <div class="card product-card h-100 position-relative overflow-hidden">

            <?php if($product['price']){ ?>
                <span class="discount-badge">
                    <?= $product['price'] ?>% OFF
                </span>
            <?php } ?>

            <div class="product-image">
                <img class="img-flued w-100" src=" uploads/<?=$product['image'] ?>" >
            </div>

            <div class="card-body p-3">

                <h6 class="card-title fw-semibold mb-2">
                    <?= $product['product_name'] ?>
                </h6>

                <div class="mb-2">

                    <div class="d-flex align-items-center mb-1">

                        <span class="price-highlight me-2">
                            ₹<?= number_format($product['price']) ?>
                        </span>

                        <?php if($product['discount_price']){ ?>
                            <span class="text-muted text-decoration-line-through small">
                                ₹<?= number_format($product['discount_price']) ?>
                            </span>
                        <?php } ?>

                    </div>

                    <div class="d-flex align-items-center gap-1 small">
                        <i class="fas fa-star stars"></i>

                        <span>
                            <?= $product['rating'] ?>
                        </span>
                    </div>

                </div>

                <button 
                    class="btn btn-warning w-100 fw-semibold py-2 add-to-cart-btn"
                    onclick="addToCart(<?= $product['id'] ?>)"
                >
                    <i class="fas fa-cart-plus me-1"></i>
                    Add to Cart
                </button>

            </div>

        </div>

    </div>

<?php } ?>

</div>