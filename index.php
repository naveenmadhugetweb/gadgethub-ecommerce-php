<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../GadgetHub/auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GadgetHub</title>
</head>
<body>

<?php include 'includes/header.php'; ?>

<h1 class="bg-primary">Welcome to GadgetHub</h1>

<form action="auth/logout.php?logout=success" method="post">
    <button type="submit">Logout</button>
</form>


</body>
</html>