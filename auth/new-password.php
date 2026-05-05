<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>New Password</title>
</head>
<body class="auth-body">

<?php include '../includes/header.php'; ?>

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">New Password</h2>
    <p class="text-center">Enter New password that don't used others</p>
    <form id="loginForm" method="post" action="password-changed.php">
        <div class="form-group">
            <label class="mt-2">New Password</label>
            <input type="password" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Confirm Password</label>
            <input type="password" class="form-control mt-2" required>
        </div>

        <button class="btn btn-primary d-block w-100 mt-2"> Change </button>

    </form>

</div>




<!-- <p>redirect register page after login successfull</p>
<a href="register.php">
    Register Page make it place route in js fn use in register page
</a> -->





<?php include '../includes/scripts.php'; ?>




</body>
</html>