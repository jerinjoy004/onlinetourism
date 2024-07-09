<?php
session_start();
error_reporting(1);
ini_set('display_errors', 1);
include('includes/config.php');

// Handle form submission for booking
if (isset($_POST['submit2'])) {
    $PackageId = intval($_GET['pkgid']);
    $UserEmail = $_SESSION['login'];
    $FromDate = $_POST['fromdate'];
    $Comment = $_POST['comment'];
    $Status = 0; // Assuming initial status is 0

    // Fetch the AgencyId associated with the package
    $sql = "SELECT agency_id FROM tourpackages WHERE PackageId = :PackageId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':PackageId', $PackageId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $agency_id = $result->agency_id;

    if ($agency_id) {
        // Insert into tblbookings
        $sql = "INSERT INTO tblbookings(AgencyId, PackageId, UserEmail, FromDate, Comment, Status) 
                VALUES(:AgencyId, :PackageId, :UserEmail, :FromDate, :Comment, :Status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':AgencyId', $agency_id, PDO::PARAM_INT); // Use the correct variable name
        $query->bindParam(':PackageId', $PackageId, PDO::PARAM_INT);
        $query->bindParam(':UserEmail', $UserEmail, PDO::PARAM_STR);
        $query->bindParam(':FromDate', $FromDate, PDO::PARAM_STR);
        $query->bindParam(':Comment', $Comment, PDO::PARAM_STR);
        $query->bindParam(':Status', $Status, PDO::PARAM_INT);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            $msg = "Booking Successful";
        } else {
            $error = "Something went wrong. Please try again";
        }
    } else {
        $error = "Agency not found for this package";
    }
}

// Handle form submission for reviews
if (isset($_POST['submit_review'])) {
    $PackageId = intval($_GET['pkgid']);
    $Email = $_POST['email'];
    $ReviewText = $_POST['review'];
    $Rating = intval($_POST['rating']);
    $ReviewDate = date('Y-m-d');

    // Insert into PackageReviews table (assuming this table exists)
    $sql = "INSERT INTO PackageReviews(PackageId, Email, Review, Rating, ReviewDate) 
            VALUES(:PackageId, :Email, :Review, :Rating, :ReviewDate)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':PackageId', $PackageId, PDO::PARAM_INT);
    $query->bindParam(':Email', $Email, PDO::PARAM_STR);
    $query->bindParam(':Review', $ReviewText, PDO::PARAM_STR);
    $query->bindParam(':Rating', $Rating, PDO::PARAM_INT);
    $query->bindParam(':ReviewDate', $ReviewDate, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if ($lastInsertId) {
        $msg_review = "Review Added Successfully";
    } else {
        $error_review = "Failed to add review. Please try again";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Package Details</title>
    <!-- Include necessary meta tags, CSS, and JavaScript -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script>
        new WOW().init();
    </script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<!-- Banner section -->
<div class="banner-3">
    <div class="container">
        <h1>Package Details</h1>
    </div>
</div>

<!-- Main content section -->
<div class="selectroom">
    <div class="container">
        <!-- PHP code to fetch and display package details -->
        <?php 
        $pid = intval($_GET['pkgid']);
        $sql = "SELECT tourpackages.*, agency.email, agency.mobile FROM tourpackages 
        JOIN agency ON tourpackages.agency_id = agency.id 
        WHERE PackageId = :pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pid', $pid, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <div class="package-details">
                    <!-- Display package details -->
                    <h2><?php echo htmlentities($result->PackageName); ?></h2>
                    <p><b>Type:</b> <?php echo htmlentities($result->PackageType); ?></p>
                    <p><b>Location:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                    <p><b>Features:</b> <?php echo htmlentities($result->PackageFeatures); ?></p>
                    <p><b>Duration:</b> <?php echo htmlentities($result->Duration); ?></p>
                    <p><b>Details:</b> <?php echo htmlentities($result->PackageDetails); ?></p>
                    
                    <!-- Display contact information of the agency -->
                    <p><b>Contact Email:</b> <?php echo htmlentities($result->email); ?></p>
                    <p><b>Contact Phone:</b> <?php echo htmlentities($result->mobile); ?></p>
                </div>
        <?php }} ?>
        
        <!-- Customer Review Section -->
        <div class="customer-reviews">
            <h3>Customer Reviews</h3>
            <!-- Display existing reviews for this package -->
            <?php
            $sql_reviews = "SELECT * FROM PackageReviews WHERE PackageId = :pid";
            $query_reviews = $dbh->prepare($sql_reviews);
            $query_reviews->bindParam(':pid', $pid, PDO::PARAM_INT);
            $query_reviews->execute();
            $reviews = $query_reviews->fetchAll(PDO::FETCH_OBJ);
            
            if ($query_reviews->rowCount() > 0) {
                foreach ($reviews as $review) { ?>
                    <div class="review">
                        <?php if (!empty($review->Email)) { ?>
                            <p><b>Email:</b> <?php echo htmlentities($review->Email); ?></p>
                        <?php } ?>
                        <p><b>Rating:</b> <?php echo htmlentities($review->Rating); ?>/5</p>
                        <p><b>Review:</b> <?php echo htmlentities($review->Review); ?></p>
                        <p><b>Date:</b> <?php echo htmlentities($review->ReviewDate); ?></p>
                    </div>
            <?php }} else { ?>
                <p>No reviews yet.</p>
            <?php } ?>
            
            <!-- Form for adding a new review -->
            <?php if (isset($_SESSION['login'])) { ?>
                <form name="submit_review" method="post">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="review">Review:</label>
                    <textarea name="review" id="review" required></textarea>
                    <label for="rating">Rating:</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" required>
                    <input type="submit" name="submit_review" value="Submit Review">
                </form>
            <?php } else { ?>
                <p>Please <a href="login.php">login</a> to add a review.</p>
            <?php } ?>
        </div>
        
        <!-- Booking Form -->
        <div class="booking-form">
            <h3>Book This Package</h3>
            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php } 
            else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php } ?>
            <form name="book" method="post">
                <p><b>From:</b> <input type="text" id="datepicker" name="fromdate" required></p>
                <p><b>Comment:</b> <textarea name="comment" required></textarea></p>
                <?php if ($_SESSION['login']) { ?>
                    <input type="submit" name="submit2" value="Book">
                <?php } else { ?>
                    <a href="login.php" class="btn btn-primary">Login to Book</a>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<!-- End of Main content section -->
<?php include('includes/footer.php'); ?>
</body>
</html>
