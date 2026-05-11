<?php

session_start();        // here used this like for to set session variable below

include '../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM products WHERE id = $id";       // record will delete products table also earbuds_details table because of foreign key relationship

    if (mysqli_query($conn, $sql)) {
        
        // var_dump("succes"); exit;
        $_SESSION['success'] = "Successfully Deleted";
        header("Location: dashboard.php");
    } else {
        
        // var_dump("Not"); exit;
        $_SESSION['error'] = "Deleted Failed";
        echo "Delete Failed";
    }
}
?>
