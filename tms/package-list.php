<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Package List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tms');

// Establish database connection.
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

// Fetch distinct PackageLocation
try {
    $sql = "SELECT DISTINCT PackageLocation FROM tbltourpackages";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>

</head>
<body>
<?php include('includes/header.php'); ?>
<!--- banner ---->
<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Package List</h1>
    </div>
</div>
<!--- /banner ---->
<!--- rooms ---->
<div class="rooms">
    <div class="container">
        <div class="search-container">
            <form method="GET">
                <select name="location">
                    <option value="">Select a location</option>
                    <?php foreach ($locations as $loc) : ?>
                        <option value="<?php echo htmlspecialchars($loc['PackageLocation']); ?>" <?php if ($_GET['location'] == $loc['PackageLocation']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($loc['PackageLocation']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="budget">
                    <option value="">Select a budget</option>
                    <option value="10000" <?php if ($_GET['budget'] == '10000') echo 'selected'; ?>>Up to 10,000</option>
                    <option value="20000" <?php if ($_GET['budget'] == '20000') echo 'selected'; ?>>Up to 20,000</option>
                    <option value="30000" <?php if ($_GET['budget'] == '30000') echo 'selected'; ?>>Up to 30,000</option>
                    <option value="40000" <?php if ($_GET['budget'] == '40000') echo 'selected'; ?>>Up to 40,000</option>
                    <option value="50000" <?php if ($_GET['budget'] == '50000') echo 'selected'; ?>>Up to 50,000</option>
                </select>
                <select name="duration">
                    <option value="">Select duration</option>
                    <option value="1" <?php if ($_GET['duration'] == '1') echo 'selected'; ?>>1 day</option>
                    <option value="2" <?php if ($_GET['duration'] == '2') echo 'selected'; ?>>2 days</option>
                    <option value="3" <?php if ($_GET['duration'] == '3') echo 'selected'; ?>>3 days</option>
                    <option value="7" <?php if ($_GET['duration'] == '7') echo 'selected'; ?>>1 Week</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="room-bottom">
            <h3>Package List</h3>

            <?php
            // Initialize an empty results array
            $results = [];

            // Get user inputs
            $location = isset($_GET['location']) ? $_GET['location'] : '';
            $budget = isset($_GET['budget']) ? $_GET['budget'] : '';
            $duration = isset($_GET['duration']) ? $_GET['duration'] : '';

            // Build the SQL query based on filters
            $sql = "SELECT * FROM tbltourpackages WHERE 1=1";

            // Adding conditions based on user inputs
            if ($location) {
                $sql .= " AND PackageLocation = :location";
            }
            if ($budget) {
                $sql .= " AND PackagePrice <= :budget";
            }
            if ($duration) {
                $sql .= " AND Duration = :duration";
            }

            $query = $dbh->prepare($sql);

            // Bind parameters
            if ($location) {
                $query->bindParam(':location', $location, PDO::PARAM_STR);
            }
            if ($budget) {
                $query->bindParam(':budget', $budget, PDO::PARAM_INT);
            }
            if ($duration) {
                $query->bindParam(':duration', $duration, PDO::PARAM_INT);
            }

            // Execute the query
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            // Display results
            if (!empty($results)) {
                foreach ($results as $result) {
                    ?>
                    <div class="rom-btm">
                        <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                            <img src="admin/packageimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                            <h4>Package Name: <?php echo htmlentities($result->PackageName); ?></h4>
                            <h6>Package Type: <?php echo htmlentities($result->PackageType); ?></h6>
                            <p><b>Package Location:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                            <p><b>Features:</b> <?php echo htmlentities($result->PackageFeatures); ?></p>
                            <p><b>Duration:</b> <?php echo htmlentities($result->Duration); ?> days</p>
                        </div>
                        <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                            <h5>INR <?php echo htmlentities($result->PackagePrice); ?></h5>
                            <a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>" class="view">Details</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No packages found matching your criteria.</p>';
            }
            ?>
        </div>
    </div>
</div>
<!--- /rooms ---->

<!--- /footer-top ---->
<?php include('includes/footer.php'); ?>
<!-- signup -->
<?php include('includes/signup.php'); ?>
<!-- //signup -->
<!-- signin -->
<?php include('includes/signin.php'); ?>
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php'); ?>
<!-- //write us -->
</body>
</html>

