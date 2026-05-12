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

            // INSERT INTO EARBUDS DETAILS
            $detailsQuery = "INSERT INTO earbuds_details 
            (product_id, name, price, description, category, battery_life, noise_control, bluetooth_version, water_resistant, warranty, color)
            VALUES 
            ('$product_id', '$name', '$price', '$description', '$category', '$battery_life', '$noise_control', '$bluetooth_version', '$water_resistant', '$warranty', '$color')";

            mysqli_query($conn, $detailsQuery);

            // var_dump("success");exit;
            
            // REDIRECT
            $_SESSION['success'] = "Prodcut Added Successfully";
            header("Location: ../dashboard.php");
            exit();
        }


    }





    function addCategory(){
        global $conn;
        // var_dump($_POST); exit;
        $name = strtolower($_POST['name']);
        $description = $_POST['description'];

        // INSERT INTO CATEGORY
        $categoryQuery = "INSERT INTO categories (category_name, description)
                         VALUES ('$name','$description')";
        $result = mysqli_query($conn, $categoryQuery);
        
        // var_dump($result); exit;
        if($result){

            $_SESSION['success'] = "category Added Successfully";
            header("Location: ../category/add-category.php");exit;
        }else{
            echo 'Something went wrong';
        }
        
    }

    function addBrand(){
        global $conn;
        // print_r($_POST);exit;

        $name = $_POST['name'];
        $logofile_name = $_FILES['image']['name'];
        $country = $_POST['country'];
        $country_id = $_POST['categoryId'];

        // var_dump("hi", $name, $country, $country_id, $logofile_name);exit;
        // INSERT INTO BRAND
        $categoryQuery = "INSERT INTO brands (brand_name, logo, country, category_id)
                         VALUES ('$name','$logofile_name', '$country', $country_id)";
        $result = mysqli_query($conn, $categoryQuery);
        // var_dump($result); exit;
        if($result){
            $_SESSION['success'] = "Brand Added Successfully";
            header("Location: ../dashboard.php");exit;
        }else{
            $_SESSION['error'] = "Already exist! Give Other Brand Name";
            echo 'Something went wrong';
            header("Location: ../brand/add-brand.php");exit;
        }
 
    }


    function editEarbuds(){
        global $conn;

        $productId = $_POST['product_id'];

            // Getting Products Datas
            $name = $_POST['name'];
            $brand_id = $_POST['brandId'];
            $category_id = $_POST['categoryId'];
            // var_dump($brand_id, $category_id); exit;
            $price = $_POST['price'];
            $d_price = $_POST['dprice'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $imageName = $_FILES['image']['name'];
            $tmpName   = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, "../../uploads/" . $imageName);

            // var_dump($_POST); exit;

            $sql = "UPDATE products SET
            product_name = '$name',
            brand_id = '$brand_id',
            category_id = '$category_id',
            price = '$price',
            discount_price = '$d_price',
            description = '$description',
            quantity = '$quantity',
            image = '$imageName'
            WHERE id='$productId'";

            $res = mysqli_query($conn, $sql);
            // var_dump("success"); exit;

            // EARBUDS DETAILS DATA
            $category = $_POST['category'];
            $battery_life = $_POST['battery_life'];
            $noise_control = $_POST['noise_control'];
            $bluetooth_version = $_POST['bluetooth_version'];
            $water_resistant = $_POST['water_resistant'];
            $warranty = $_POST['warranty'];
            $color = $_POST['color'];

            // UPDATE EARBUDS DETAILS
        
            $sql ="UPDATE earbuds_details SET
            product_id = '$productId',
            name = '$name',
            price ='$price',
            description ='$description',
            category ='$category',
            battery_life ='$battery_life',
            noise_control ='$noise_control',
            bluetooth_version ='$bluetooth_version',
            water_resistant ='$water_resistant',
            warranty ='$warranty',
            color ='$color'
            WHERE product_id='$productId'";

            $result = mysqli_query($conn, $sql);
            
            // REDIRECT
            $_SESSION['success'] = "Prodcut Updated Successfully";
            header("Location: ../dashboard.php");
            exit();

    }



    function addSmartphones(){
        global $conn;        
        // print_r("Hi"); exit;
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

            // Getting products form datas
            $name = $_POST['name'];
            $price = $_POST['price'];
            $d_price = $_POST['dprice'];            
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            // var_dump($_FILES); exit;
            // FILE UPLOAD
            $imageName = $_FILES['image']['name'];
            $tmpName   = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, "../../uploads/" . $imageName);
            // var_dump("uploadded"); exit;

            // INSERT INTO PRODUCTS FIRST
            $productQuery = "INSERT INTO products (product_name, brand_id, category_id, price, discount_price, description, quantity, image)
                             VALUES ('$name','$brandId', '$categoryId', '$price','$d_price', '$description','$quantity', '$imageName ')";

            mysqli_query($conn, $productQuery);
            // GET LAST INSERTED PRODUCT ID
            $product_id = mysqli_insert_id($conn);

            // SMARTPHONES DETAILS DATA
            $model = $_POST['model'];
            $ram = $_POST['ram'];
            $storage = $_POST['storage'];
            $processor = $_POST['processor'];
            $cameraFront = $_POST['camera_front_mp'];
            $cameraRear  = $_POST['camera_rear_mp'];
            $battery  = $_POST['battery'];
            $displaySize  = $_POST['display_size'];
            $operatingSystem  = $_POST['operating_system'];
            $color  = $_POST['color'];
            $warranty  = $_POST['warranty'];
            $networkType  = $_POST['network_type'];
            $simType  = $_POST['sim_type'];
            $refreshRate  = $_POST['refresh_rate'];
            $fastCharging  = $_POST['fast_charging'];
            $fingerprintSensor  = $_POST['fingerprint_sensor'];
            $launchYear  = $_POST['launch_year'];

            // INSERT INTO EARBUDS DETAILS
            $detailsQuery = "INSERT INTO smartphone_details 
            (product_id, name, category, description, price, model, ram, storage, processor, camera_front_mp, camera_rear_mp, battery, display_size, operating_system, color, warranty, network_type, sim_type, refresh_rate, fast_charging, fingerprint_sensor, launch_year)
            VALUES 
            ('$product_id', '$name', '$category','$description', '$price', '$model', '$ram', '$storage', '$processor', '$cameraFront', '$cameraRear', '$battery', '$displaySize', '$operatingSystem','color', '$warranty', '$networkType', '$simType', '$refreshRate','$fastCharging', '$fingerprintSensor','$launchYear')";

            mysqli_query($conn, $detailsQuery);
            // var_dump("success");exit;
            // REDIRECT
            $_SESSION['success'] = "Prodcut Added Successfully";
            header("Location: ../dashboard.php");
            exit();
        }
    }

    function editSmartphon(){
        global $conn;

            // Getting Hidden type data
            $productId = $_POST['productId'];
            $brand_id = $_POST['brandId'];
            $category_id = $_POST['categoryId'];
            $category = $_POST['category'];

            // Getting Products Datas
            $name = $_POST['name'];
            $price = $_POST['price'];
            $d_price = $_POST['dprice'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $imageName = $_FILES['image']['name'];
            $tmpName   = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, "../../uploads/" . $imageName);
            // var_dump($_POST); exit;

            $sql = "UPDATE products SET

            product_name = '$name',
            brand_id = '$brand_id',
            category_id = '$category_id',
            price = '$price',
            discount_price = '$d_price',
            description = '$description',
            quantity = '$quantity',
            image = '$imageName'
            WHERE id='$productId'";

            $res = mysqli_query($conn, $sql);
            // var_dump("success"); exit;

            // SMARTPHONE DETAILS DATA
            $model = $_POST['model'];
            $ram = $_POST['ram'];
            $storage = $_POST['storage'];
            $processor = $_POST['processor'];
            $cameraFront = $_POST['camera_front_mp'];
            $cameraRear  = $_POST['camera_rear_mp'];
            $battery  = $_POST['battery'];
            $displaySize  = $_POST['display_size'];
            $operatingSystem  = $_POST['operating_system'];
            $color  = $_POST['color'];
            $warranty  = $_POST['warranty'];
            $networkType  = $_POST['network_type'];
            $simType  = $_POST['sim_type'];
            $refreshRate  = $_POST['refresh_rate'];
            $fastCharging  = $_POST['fast_charging'];
            $fingerprintSensor  = $_POST['fingerprint_sensor'];
            $launchYear  = $_POST['launch_year'];

            // UPDATE SMARTPHONES DETAILS        
            $sql ="UPDATE smartphone_details SET
            product_id = '$productId',
            name = '$name',
            category   = '$category',
            description   = '$description',
            price   = '$price',
            model   = '$model',
            ram   = '$ram',
            storage   = '$storage',
            processor   = '$processor',
            camera_front_mp   = '$cameraFront',
            camera_rear_mp   = '$cameraRear',
            battery   = '$battery',
            display_size   = '$displaySize',
            operating_system   = '$operatingSystem',
            color   = '$color',
            warranty   = '$warranty',
            network_type   = '$networkType',
            sim_type   = '$simType',
            refresh_rate   = '$refreshRate',
            fast_charging   = '$fastCharging',
            fingerprint_sensor = '$fingerprintSensor',
            launch_year ='$launchYear'
            WHERE product_id='$productId'";

            $result = mysqli_query($conn, $sql);
            
            // REDIRECT
            $_SESSION['success'] = "Prodcut Updated Successfully";
            header("Location: ../dashboard.php");
            exit();
    }






    


?>
