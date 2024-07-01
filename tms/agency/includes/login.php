<?php
session_start();
include('config.php'); // Include your database configuration file

// Handle signup form submission
if (isset($_POST['signup'])) {
    $agencyName = $_POST['agencyName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password
    $mobile = $_POST['mobile'];

    $query = "INSERT INTO agency (agencyName, email, address, username, password, mobile, RegDate) 
              VALUES ('$agencyName', '$email', '$address', '$username', '$password', '$mobile', NOW())";
    
    if (mysqli_query($conn, $query)) {
        $signup_message = "Signup successful!";
    } else {
        $signup_message = "Error: " . mysqli_error($conn);
    }
}

// Handle signin form submission
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password

    $query = "SELECT * FROM agency WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $agency = mysqli_fetch_assoc($result);
        $_SESSION['agency_login'] = $username;
        $_SESSION['agency_id'] = $agency['id']; // Store agency_id in session
        header("Location: dashboard.php");
        exit;
    } else {
        $signin_error = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agency Login</title>
</head>
<body>
    <!-- Signup Form -->
    <h2>Signup</h2>
    <?php if (isset($signup_message)) { echo "<p>$signup_message</p>"; } ?>
    <form action="login.php" method="post">
        <label for="agencyName">Agency Name:</label>
        <input type="text" name="agencyName" id="agencyName" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" id="mobile" required><br>

        <button type="submit" name="signup">Signup</button>
    </form>

    <!-- Signin Form -->
    <h2>Signin</h2>
    <?php if (isset($signin_error)) { echo "<p>$signin_error</p>"; } ?>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit" name="signin">Signin</button>
    </form>

    <a href="../../../tms">Back to Home</a>
</body>
</html>
