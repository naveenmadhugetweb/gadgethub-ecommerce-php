<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Password changed</title>
</head>
<body class="auth-body">

<?php include '../includes/header.php'; ?>

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Password Changed</h2>
    <p class="text-center">Your password changed. Now you can login now with new your password.</p>
    <form id="loginForm" action="login.php" method="post">
        <button class="btn btn-primary d-block w-100 mt-2 fw-bold"> Login Now </button>
    </form>

</div>




<!-- <p>redirect register page after login successfull</p>
<a href="register.php">
    Register Page make it place route in js fn use in register page
</a> -->





<?php include '../includes/scripts.php'; ?>




</body>
</html>