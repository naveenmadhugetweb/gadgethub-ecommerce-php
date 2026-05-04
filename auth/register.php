<?php include '../includes/header.php'; ?>
<?php include '../includes/auth_functions.php'; ?>
<?php
        session_start();
 ?>
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $conpassword = $_POST['conpwd'];
        register($name, $email, $password, $conpassword);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Register Page</title>
</head>
<body class="auth-body">


<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Signup Form</h2>
    <p class="text-center">It's quick and easy.</p>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
    <?php unset($_SESSION['error']); endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']); endif; ?>

    <form id="loginForm" method="post" action="register.php">
        <div class="form-group">
            <label class="mt-2">Enter Full Name</label>
            <input type="text" name="name" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Email Address</label>
            <input type="email" name="email" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Password</label>
            <input type="password" name="pwd" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Confirm Password</label>
            <input type="password" name="conpwd" class="form-control mt-2" required>
        </div>

        <button class="btn btn-primary d-block w-100 mt-2"> Signup </button>
        <p class="mt-3">Already a member? <a href="login.php">Login here</a></p>

    </form>

</div>


<?php include '../includes/scripts.php'; ?>


</body>
</html>
