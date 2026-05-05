<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../includes/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';



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

             // Hash password
            // $password = password_hash($password, PASSWORD_DEFAULT);
        
            // Generate OTP
            $code = rand(100000, 999999);
        
            // Insert user with OTP
            $query = "UPDATE  users set code ='$code' WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            if($result){

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {

                    //Server settings
                    //$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output

                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'naveenmpvkn1717@gmail.com';                     //SMTP username
                    $mail->Password   = 'hsscykwebhtxpksw';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    // var_dump("cursor here  sent"); exit;

                    //Recipients
                    $mail->setFrom('naveenmadhu8870@gmail.com', 'Mailer From GadgetHub');
                    $mail->addAddress('naveenmadhu8870@gmail.com', 'Naveen');     //Add a recipient
                    // $mail->addAddress('ellen@example.com');                    //Name is optional
                    $mail->addReplyTo('naveenvisionmpvkn@gmail.com', 'Information');   // Reply to mail id when receipient reply 
                    $mail->addCC('cc@example.com');
                    $mail->addBCC('bcc@example.com');

                    // var_dump("cursor here  sent"); exit;

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'This is the HTML message body <b>in bold! Code is : '. $code .' </b>';
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    // $mail->send();

                // store email in session for verification step
                $_SESSION['verify_email'] = $email;
                $_SESSION['message'] = "we have sented verification code to your mail id";

                // Update users
                $query = "UPDATE  users set verified ='1' WHERE email='$email'";
                mysqli_query($conn, $query);

                header("Location: reset-password.php");
                exit;

                } catch (Exception $e) {
                    // var_dump("else");exit;

                    $_SESSION['error'] = "Message could not be sent. Mailer Error Check Valid both mails";
                    header("Location: forgot-password.php");
                    exit;
                }                   
            }
        }else{
                // var_dump("else");exit;
                $_SESSION['error'] = "Enter correct email id";
                header("Location: forgot-password.php");
                exit;
        }
    }

    function verifyOTP($otp, $email){
        global $conn;
        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result); // fetch row as array
            // var_dump($email, "||", $otp, $user['name'], $user['code'], $otp); exit; // access column

            if($user['code'] == $otp){
                header("Location: ../index.php");
                exit;
            }else{
                $_SESSION['error'] = "wrong verification code! check your mail";
                header("Location: reset-password.php");
                exit;
            }
        } else {
            // echo "User not found";
            $_SESSION['error'] = "Something went wrong! login again";
            header("Location: reset-password.php");
            exit;
        }

    }


?>