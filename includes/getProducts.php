<?php

include '../config/database.php';

//$sql = "SELECT * FROM products"; 
// use this when wan't also category and brand name from their tables 
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
$result = mysqli_query($conn, $sql);
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;            // Add each row into array
}
// print_r($products);exit;
header('Content-Type: application/json');
echo json_encode($products);

?>