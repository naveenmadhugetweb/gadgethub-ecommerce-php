<?php include '../includes/header.php'; ?>
<?php include '../includes/auth_functions.php'; ?>

<?php
    session_start();

    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/auth.css">
    <script src="../assets/js/app.js"></script>
    <title>Logged Out</title>
</head>
<body class="auth-body">
    
    <div class="container border border-primary rounded p-5 w-50 fw-bold auth-container">

        <!-- <h2>You have been logged out</h2> -->
        <!-- <a class="btn btn-primary" href="login.php">Go to Login</a> -->

    </div>

    <!-- Modal -->
    <div class="modal fade" id="cartModalCenter" tabindex="-1" role="dialog" aria-labelledby="productModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="productModalLongTitle">Logged Out</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <!-- <span>&times;</span> -->
            </button>
          </div>
          <div class="modal-body" style="background-color: rgb(135, 176, 139);">
            <h2 style="font-family: cursive;">You are logged out Successfully</h2>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="login.php"><button type="button" class="btn btn-primary">Go to Login</button></a>
          </div>
        </div>
      </div>
    </div>

</body>
</html>
