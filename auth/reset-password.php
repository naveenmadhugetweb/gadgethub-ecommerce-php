<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Verify code page</title>
</head>
<body class="auth-body">

<?php include '../includes/header.php'; ?>

<div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

    <h2 class="text text-primary text-center">Code Verification</h2>
    <p class="text-center">Enter verification code that sent a email address</p>
    <form id="loginForm" action="new-password.php" method="post">
        <div class="form-group">
            <label class="mt-2">Enter verification code</label>
            <input type="number" class="form-control mt-2" required>
        </div>

        <button class="btn btn-primary d-block w-100 mt-2 fw-bold"> Submit </button>
    </form>
</div>

<?php include '../includes/scripts.php'; ?>

</body>
</html>