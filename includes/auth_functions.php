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

    function register($name, $email, $password, $conpassword) {
        global $conn;

        // var_dump("inside register"); exit;
        
        if($password == $conpassword){
 
            $query = "INSERT INTO users (name, email, password) values ('$email', '$email', '$password')";
            $result = mysqli_query($conn, $query);
            if($result){
                //var_dump("inserted"); exit;
                $_SESSION['success'] = "Registered successfully! please login";
                header("Location: register.php");
                exit;
            }else{
                //var_dump("Not inserted"); exit;
                $_SESSION['error'] = "Registration Failed";
                header("Location: register.php");
                exit;
            }

        }else{
                $_SESSION['error'] = "password mismatch";
                header("Location: register.php");
                exit;
        }
        
    }

    function forgotPassword($email){
        global $conn;

        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        // var_dump($result, "|||" , $result->num_rows); exit;
        if($result->num_rows > 0){
            // var_dump("hi");exit;
            header("Location: reset-password.php");
            exit;
        }else{
            // var_dump("else");exit;
            $_SESSION['error'] = "email mismatch";
            header("Location: forgot-password.php");
            exit;
        }
    }


?>