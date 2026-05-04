<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">

    <title>Register Page</title>
</head>
<body class="auth-body">

<?php include '../includes/header.php'; ?>

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Signup Form</h2>
    <p class="text-center">It's quick and easy.</p>
    <form id="loginForm" action="">
        <div class="form-group">
            <label class="mt-2">Enter Full Name</label>
            <input type="text" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Email Address</label>
            <input type="email" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Password</label>
            <input type="password" class="form-control mt-2" required>
        </div>
        <div class="form-group">
            <label class="mt-2">Confirm Password</label>
            <input type="password" class="form-control mt-2" required>
        </div>

        <button class="btn btn-primary d-block w-100 mt-2"> Signup </button>
        <p class="mt-3">Already a member? <a href="login.php">Login here</a></p>

    </form>

</div>


<?php include '../includes/scripts.php'; ?>


</body>
</html>
