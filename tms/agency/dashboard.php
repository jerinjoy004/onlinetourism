<?php
session_start();
if (!isset($_SESSION['agency_login'])) {
    header("Location: login.php");
    exit;
}

// Dashboard content goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <p>Agency Name: <?php echo htmlentities($_SESSION['agency_login']); ?></p>
    <!-- Add dashboard content here -->
</body>
</html>
