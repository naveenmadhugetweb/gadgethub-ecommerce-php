<?php include '../includes/header.php';?>
<?php include '../includes/auth_functions.php'; ?>
<?php
        session_start();
 ?>


<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        loginUser($email, $password);
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Login Page</title>
</head>
<body class="auth-body">

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Login Form</h2>
    <p class="text-center">Login with your email and password</p>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
    <?php unset($_SESSION['error']); endif; ?>

    <form id="loginForm" method="post" action="login.php">
        <div class="form-group">
            <label class="mt-2">Email address</label>
            <input type="email" name="email" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Password</label>
            <input type="password" name="password" class="form-control mt-2" required>
        </div>
        <a href="forgot-password.php" class="mt-2">forgot password?</a>        
        <button class="btn btn-primary d-block w-100 mt-2"> Login </button>
        <p class="mt-3">Not yet a member? <a href="register.php">Signup now</a></p>
    </form>

</div>


<?php include '../includes/scripts.php'; ?>




</body>
</html>