<!-- Redirecting which product category to redirect -->
<?php

session_start();

include '../config/database.php';

$id = intval($_GET['id']);

$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// var_dump($product['category_id']);exit;

$categoryId =  $product['category_id'];

$sql = "SELECT * FROM categories WHERE id = $categoryId";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);

// var_dump($category['category_name']);exit;

$categoryName = $category['category_name'];

if($categoryName == 'earbuds'){

    $productId = $product['id'];
    // var_dump("his", $productId);exit;
    $sql = "SELECT * FROM earbuds_details WHERE product_id = $productId";
    $result = mysqli_query($conn, $sql);
    $earbudsData = mysqli_fetch_assoc($result);

    // var_dump("his", $earbudsData);exit;

    $_SESSION['product'] = $product;
    $_SESSION['earbudsData'] = $earbudsData;

    header("Location: ../admin/products/edit-earbuds-details.php");
}
elseif($categoryName = 'smartphones'){
    var_dump("smartphones your seleted not options will added yet to update");exit;
}
elseif($categoryName = 'laptops'){
    var_dump("smartphones your seleted not options will added yet to update");exit;
}else{
    var_dump("your seleted product not availabe to update");exit;
}


?>