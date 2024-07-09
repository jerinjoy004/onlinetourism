<?php
session_start();
include('includes/config.php'); // Include your database configuration file

// Check if agency is logged in
if (!isset($_SESSION['agency_login'])) {
    header('location: login.php');
    exit;
}

// Fetch agency details
$username = $_SESSION['agency_login'];
$query = "SELECT * FROM agency WHERE username = '$username'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Error fetching agency details.");
}
$agency = mysqli_fetch_assoc($result);

// Fetch total packages created by the agency
$query_packages = "SELECT COUNT(*) AS total_packages FROM tourpackages WHERE agency_id = '{$agency['id']}'";
$result_packages = mysqli_query($conn, $query_packages);
$total_packages = mysqli_fetch_assoc($result_packages)['total_packages'];

// Fetch total bookings for the agency
$query_bookings = "SELECT COUNT(*) AS total_bookings FROM tblbookings WHERE AgencyId = '{$agency['id']}'";
$result_bookings = mysqli_query($conn, $query_bookings);
$total_bookings = mysqli_fetch_assoc($result_bookings)['total_bookings'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Adjust path as needed -->

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for dashboard layout */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }

        .page-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .dashboard-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-box {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            flex: 1;
            text-align: center;
        }

        .stat-box h3 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .stat-box p {
            font-size: 16px;
            color: #666;
        }

        .recent-activity {
            margin-top: 20px;
        }

        .activity-item {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fafafa;
            border-left: 5px solid #3498db;
        }

        .activity-item p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .activity-item .timestamp {
            font-size: 12px;
            color: #888;
        }

        .activity-item .user {
            font-weight: 700;
        }

        /* Media query for responsiveness */
        @media (max-width: 768px) {
            .dashboard-stats {
                flex-direction: column;
            }

            .stat-box {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    
        <header>
            <!-- Include your header content here -->
            <?php include('includes/header.html'); ?>
        </header>


    <!-- Agency Details -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Agency Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Agency Name:</strong> <?php echo $agency['agencyName']; ?></p>
            <p><strong>Email:</strong> <?php echo $agency['email']; ?></p>
            <p><strong>Address:</strong> <?php echo $agency['address']; ?></p>
            <p><strong>Username:</strong> <?php echo $agency['username']; ?></p>
            <p><strong>Mobile:</strong> <?php echo $agency['mobile']; ?></p>
            <!-- Add more details as needed -->
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">
        <!-- Total Packages -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Total Packages Created</h4>
                </div>
                <div class="card-body">
                    <h1 class="text-center"><?php echo $total_packages; ?></h1>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Total Bookings</h4>
                </div>
                <div class="card-body">
                    <h1 class="text-center"><?php echo $total_bookings; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="card">
        <div class="card-header">
            <h3>Recent Bookings</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Package Name</th>
                            <th>User Email</th>
                            <th>From Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_recent_bookings = "SELECT * FROM tblbookings WHERE AgencyId = '{$agency['id']}' ORDER BY BookingId DESC LIMIT 5";
                        $result_recent_bookings = mysqli_query($conn, $query_recent_bookings);
                        if (mysqli_num_rows($result_recent_bookings) > 0) {
                            while ($booking = mysqli_fetch_assoc($result_recent_bookings)) {
                                echo "<tr>";
                                echo "<td>{$booking['BookingId']}</td>";
                                // Fetch package details
                                $package_id = $booking['PackageId'];
                                $query_package = "SELECT PackageName FROM tourpackages WHERE PackageId = '$package_id'";
                                $result_package = mysqli_query($conn, $query_package);
                                $package_name = mysqli_fetch_assoc($result_package)['PackageName'];
                                echo "<td>{$package_name}</td>";
                                echo "<td>{$booking['UserEmail']}</td>";
                                echo "<td>{$booking['FromDate']}</td>";
                                $status = $booking['Status'];
                                $status_text = '';
                                switch($status){
                                    case 0:
                                        $status_text = 'Pending';
                                        break;
                                    case 1:
                                        $status_text = 'Confirmed';
                                        break;
                                    case 2:
                                        $status_text = 'Cancelled';
                                        break;}
                                echo "<td>{$status_text}</td>";
                                }
                                echo "</tr>";
                            }
                        else {
                            echo "<tr><td colspan='6'>No bookings found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap JS and other scripts -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Additional scripts or JS libraries can be included here -->
</body>
</html>
