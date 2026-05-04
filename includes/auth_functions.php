<?php

require '../config/database.php';

function loginUser($email, $password) {
    global $conn;                         // 1. simple methdod: access global variable inside fn
                                          // 2. if don't want method 1. then sent and receive fn like loginUser($conn, $email, $password) 
    // var_dump("Entered loginUser" , $email , $password); exit;

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
                    
    // var_dump("Entered loginUser"); exit;
                    
    if ($user = mysqli_fetch_assoc($result)) {

            // Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            // var_dump('hi', $_SESSION['user_id'] ,$_SESSION['user_email'] );
            // exit; 
            if($user['email'] == $email){
                if($user['password'] == $password){
                    // var_dump("password matched"); exit;
                    
                    // Redirect to dashboard/home
                    header("Location: ../index.php");
                    exit();                                     // exit() stmt must after header();
                }else{
                    // var_dump("invalid password"); exit;
                    $_SESSION['error'] = "Invalid password";
                    header("Location: login.php");
                    exit;
                }
            }else{
                // var_dump("Invalid email id"); exit;
                $_SESSION['error'] = "Invalid Email id";
                header("Location: login.php");
                exit;
            }
    } else {
        // var_dump("Invalid email id"); exit;            
        $_SESSION['error'] = "Invalid email id";            
        header("Location: login.php");
        exit;
    }


}

?>