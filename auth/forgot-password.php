<?php include '../includes/header.php'; ?>
<?php include '../includes/auth_functions.php'; ?>
<?php
        session_start();
 ?>
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        forgotPassword($email);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Forgot Password</title>
</head>
<body class="auth-body">

<?php include '../includes/header.php'; ?>

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Forgot Password</h2>
    <p class="text-center">Enter your email address</p>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
    <?php unset($_SESSION['error']); endif; ?>

    <form method="post" action="forgot-password.php" id="loginForm">
        <div class="form-group">
            <label class="mt-2">Email address</label>
            <input type="email" name="email" class="form-control mt-2" require>
        </div>

        <button class="btn btn-primary d-block w-100 mt-2 fw-bold"> Continue </button>

    </form>

</div>

<?php include '../includes/scripts.php'; ?>


</body>
</html>