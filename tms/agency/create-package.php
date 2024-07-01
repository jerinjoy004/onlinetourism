<?php
session_start();
include('includes/config.php'); // Include your database configuration file

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the agency is logged in
if (!isset($_SESSION['agency_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PackageName = $_POST['PackageName'];
    $PackageType = $_POST['PackageType'];
    $PackageLocation = $_POST['PackageLocation'];
    $PackagePrice = $_POST['PackagePrice'];
    $PackageFeatures = $_POST['PackageFeatures'];
    $PackageDetails = $_POST['PackageDetails'];
    $Duration = $_POST['Duration'];
    $Stay = $_POST['Stay'];
    $agency_id = $_SESSION['agency_id'];

    // Insert into database
    $query = "INSERT INTO tourpackages (agency_id, PackageName, PackageType, PackageLocation, PackagePrice, PackageFeatures, PackageDetails, Duration, Stay) 
              VALUES ('$agency_id', '$PackageName', '$PackageType', '$PackageLocation', '$PackagePrice', '$PackageFeatures', '$PackageDetails', '$Duration', '$Stay')";

    if (mysqli_query($conn, $query)) {
        $success = "Package added successfully.";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Package</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: vertical;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error, .success {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
	<?php include('includes/header.html'); ?>
    <div class="container">
        <h2>Create Package</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>

        <form action="create-package.php" method="post">
            <div class="form-group">
                <label for="PackageName">Package Name:</label>
                <input type="text" name="PackageName" id="PackageName" required>
            </div>

            <div class="form-group">
                <label for="PackageType">Package Type:</label>
                <input type="text" name="PackageType" id="PackageType" required>
            </div>

            <div class="form-group">
                <label for="PackageLocation">Package Location:</label>
                <input type="text" name="PackageLocation" id="PackageLocation" required>
            </div>

            <div class="form-group">
                <label for="PackagePrice">Package Price:</label>
                <input type="number" name="PackagePrice" id="PackagePrice" required>
            </div>

            <div class="form-group">
                <label for="PackageFeatures">Package Features:</label>
                <input type="text" name="PackageFeatures" id="PackageFeatures" required>
            </div>

            <div class="form-group">
                <label for="PackageDetails">Package Details:</label>
                <textarea name="PackageDetails" id="PackageDetails" required></textarea>
            </div>

            <div class="form-group">
                <label for="Duration">Duration:</label>
                <input type="text" name="Duration" id="Duration" required>
            </div>

            <div class="form-group">
                <label for="Stay">Stay:</label>
                <input type="text" name="Stay" id="Stay" required>
            </div>

            <button type="submit">Create Package</button>
        </form>
    </div>
</body>
</html>
