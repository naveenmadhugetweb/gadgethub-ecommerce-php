<?php

    include '../../config/database.php';

    function addEarbuds() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // print_r($_POST); exit;

            $category = strtolower( $_POST['category']);
            $sql = "SELECT * FROM categories WHERE category_name = '$category' ";
            $res = mysqli_query($conn, $sql);
            $categoryData = mysqli_fetch_assoc($res);
            $categoryId = $categoryData['id'];

            // print_r($categoryId); exit;

            $brand_id = $_POST['brandId'];
            $query = "SELECT * FROM brands WHERE id = '$brand_id' ";
            $result = mysqli_query($conn, $query);
            $brandData = mysqli_fetch_assoc($result);
            $brandId = $brandData['id'];

            // var_dump($brandId, $categoryId); exit;

            // Getting products table datas
            $name = $_POST['name'];
            $price = $_POST['price'];
            $d_price = $_POST['dprice'];            
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $category = $_FILES['image']['name'];

            // Files accessed by $_FILES 
            // $image = $_FILES['image'];

            //Specific access -> later add on 
            // $file_name = $_FILES['image']['name'];
            // $file_tmp  = $_FILES['image']['tmp_name'];
            // $file_size = $_FILES['image']['size'];
            // $file_type = $_FILES['image']['type'];

            $battery_life = $_POST['battery_life'];
            $noise_control = $_POST['noise_control'];
            $bluetooth_version = $_POST['bluetooth_version'];
            $water_resistant = $_POST['water_resistant'];
            $warranty = $_POST['warranty'];
            $color = $_POST['color'];

            // PRODUCT DATA
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category = $_POST['category'];

            // var_dump($_FILES); exit;
            // FILE UPLOAD
            $imageName = $_FILES['image']['name'];
            $tmpName   = $_FILES['image']['tmp_name'];

            move_uploaded_file($tmpName, "../../uploads/" . $imageName);
            // var_dump("uploadded"); exit;
            $category_id = $categoryId;

            $brand_id = $brandId;

            // var_dump($_POST); exit;
            // var_dump($_FILES['image']['name']); exit;

            // INSERT INTO PRODUCTS FIRST
            $productQuery = "INSERT INTO products (product_name, brand_id, category_id, price, discount_price, description, quantity, image)
                             VALUES ('$name','$brand_id', '$category_id', '$price','$d_price', '$description','$quantity', '$imageName ')";

            mysqli_query($conn, $productQuery);

            // GET LAST INSERTED PRODUCT ID
            $product_id = mysqli_insert_id($conn);
 

            // EARBUDS DETAILS DATA
            $battery_life = $_POST['battery_life'];
            $noise_control = $_POST['noise_control'];
            $bluetooth_version = $_POST['bluetooth_version'];
            $water_resistant = $_POST['water_resistant'];
            $warranty = $_POST['warranty'];
            $color = $_POST['color'];

            // INSERT INTO EARBUDS DETAILS
            $detailsQuery = "INSERT INTO earbuds_details 
            (product_id, name, price, description, category, battery_life, noise_control, bluetooth_version, water_resistant, warranty, color)
            VALUES 
            ('$product_id', '$name', '$price', '$description', '$category', '$battery_life', '$noise_control', '$bluetooth_version', '$water_resistant', '$warranty', '$color')";

            mysqli_query($conn, $detailsQuery);

            // var_dump("success");exit;
            
            // REDIRECT

            header("Location: ../dashboard.php");
            exit();
        }


    }





    function addCategory(){
        global $conn;
        $name = $_POST['name'];
        $description = $_POST['description'];

        // INSERT INTO CATEGORY
        $categoryQuery = "INSERT INTO categories (category_name, description)
                         VALUES ('$name','$description')";
        $result = mysqli_query($conn, $categoryQuery);
        
        // var_dump($result); exit;
        if($result){
            header("Location: ../brand/add-brand.php");exit;
        }else{
            echo 'Something went wrong';
        }
        
    }

    function addBrand(){
        global $conn;
        // print_r($_POST);exit;

        $name = $_POST['name'];
        $logo = $_POST['logo'];
        // $logofile_name = $_FILES['logo']['name'];
        $country = $_POST['country'];

        // var_dump("hi", $name, $logo, $country);exit;
        // INSERT INTO BRAND
        $categoryQuery = "INSERT INTO brands (brand_name, logo, country)
                         VALUES ('$name','$logo', '$country')";
        $result = mysqli_query($conn, $categoryQuery);
        // var_dump($result); exit;
        if($result){
            header("Location: ../dashboard.php");exit;
        }else{
            echo 'Something went wrong';
        }
 
    }







    


?>
