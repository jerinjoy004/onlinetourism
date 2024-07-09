<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['agency_login']) == 0) {
    header('location:includes/login.php');
} else {
    $agency_id = $_SESSION['agency_id']; // Assuming you store agency_id in session

    if (isset($_POST['update'])) {
        $packageId = $_POST['PackageId'];
        $packageName = $_POST['PackageName'];
        $packageType = $_POST['PackageType'];
        $packageLocation = $_POST['PackageLocation'];
        $packagePrice = $_POST['PackagePrice'];
        $packageFeatures = $_POST['PackageFeatures'];
        $packageDetails = $_POST['PackageDetails'];
        $duration = $_POST['Duration'];
        $stay = $_POST['Stay'];
        
        $sql = "UPDATE tourpackages SET PackageName = ?, PackageType = ?, PackageLocation = ?, PackagePrice = ?, PackageFeatures = ?, PackageDetails = ?, Duration = ?, Stay = ? WHERE PackageId = ? AND agency_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssdssiii', $packageName, $packageType, $packageLocation, $packagePrice, $packageFeatures, $packageDetails, $duration, $stay, $packageId, $agency_id);

        if ($stmt->execute()) {
            $msg = "Package updated successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }

    if (isset($_POST['delete'])) {
        $packageId = $_POST['PackageId'];
        
        $sql = "DELETE FROM tourpackages WHERE PackageId = ? AND agency_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $packageId, $agency_id);

        if ($stmt->execute()) {
            $msg = "Package deleted successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }

    $sql = "SELECT * FROM tourpackages WHERE agency_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $agency_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $packages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Packages</title>
    <style>
		body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table td input[type="text"] {
    width: 100%;
    padding: 6px;
    box-sizing: border-box;
    border: 1px solid #ddd;
}

table td button {
    padding: 6px 12px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    cursor: pointer;
}

table td button:hover {
    background-color: #45a049;
}

.errorWrap, .succWrap {
    margin: 20px 0;
    padding: 10px;
    border-radius: 4px;
}

.errorWrap {
    background-color: #f44336;
    color: white;
}

.succWrap {
    background-color: #4CAF50;
    color: white;
}

form {
    margin: 0;
}

button {
    cursor: pointer;
}

	</style>
</head>
<body>
    <?php include('includes/header.html'); ?>
    <div class="container">
        <h2>Manage Your Packages</h2>
        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div><?php } ?>
        <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div><?php } ?>
        
        <table>
            <thead>
                <tr>
                    <th>Package ID</th>
                    <th>Package Name</th>
                    <th>Package Type</th>
                    <th>Package Location</th>
                    <th>Package Price</th>
                    <th>Package Features</th>
                    <th>Package Details</th>
                    <th>Duration</th>
                    <th>Stay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $package) { ?>
                <tr>
                    <form method="post">
                        <td><?php echo htmlentities($package['PackageId']); ?><input type="hidden" name="PackageId" value="<?php echo htmlentities($package['PackageId']); ?>"></td>
                        <td><input type="text" name="PackageName" value="<?php echo htmlentities($package['PackageName']); ?>"></td>
                        <td><input type="text" name="PackageType" value="<?php echo htmlentities($package['PackageType']); ?>"></td>
                        <td><input type="text" name="PackageLocation" value="<?php echo htmlentities($package['PackageLocation']); ?>"></td>
                        <td><input type="text" name="PackagePrice" value="<?php echo htmlentities($package['PackagePrice']); ?>"></td>
                        <td><input type="text" name="PackageFeatures" value="<?php echo htmlentities($package['PackageFeatures']); ?>"></td>
                        <td><input type="text" name="PackageDetails" value="<?php echo htmlentities($package['PackageDetails']); ?>"></td>
                        <td><input type="text" name="Duration" value="<?php echo htmlentities($package['Duration']); ?>"></td>
                        <td><input type="text" name="Stay" value="<?php echo htmlentities($package['Stay']); ?>"></td>
                        <td>
                            <button type="submit" name="update">Update</button>
                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this package?');">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
}
?>