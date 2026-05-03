<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/auth.css">

    <title>Login Page</title>
</head>
<body>


<?php include '../includes/header.php'; ?>

<h2>Login Page</h2>


<div class="container">

    <h2>Login</h2>

    <form id="loginForm">

        <input type="email"
               class="form-control">

        <input type="password"
               class="form-control">

        <button class="btn btn-primary">
            Login
        </button>

    </form>

</div>




<p>redirect register page after login successfull</p>
<a href="register.php">
    Register Page make it place route in js fn
</a>





<?php include '../includes/scripts.php'; ?>




</body>
</html>