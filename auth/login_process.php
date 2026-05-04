<?php
session_start();
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

        // echo "<script>
        //     alert('checks values');
        // </script>" . $email . "|||" . $password ;
        // exit; 

    // Example query
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if ($user = mysqli_fetch_assoc($result)) {

            // Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            // var_dump($_SESSION['user_id'] ,$_SESSION['user_email'] );
            // exit; 
            if($user['email'] == $email){
                if($user['password'] == $password){
                    //var_dump("password matched"); exit;
                    
                    // Redirect to dashboard/home
                    header("Location: ../index.php");
                    exit();
                }else{
                    //var_dump("invalid password"); exit;
                    $_SESSION['error'] = "Invalid password";
                    header("Location: login.php");

                }
            }else{
                //var_dump("Invalid email id"); exit;
                $_SESSION['error'] = "Invalid Email id";
                header("Location: login.php");
            }
    } else {
        // var_dump("Invalid email id"); exit;            
        $_SESSION['error'] = "Invalid email id";
        header("Location: login.php");
    }
}


?>











<?php
/*
require_once '../config/db.php';

// Now you can use $conn
$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
    echo $row['email'];
}
*/
?>
