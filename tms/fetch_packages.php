<?php
include('includes/config.php');

if (isset($_GET['location'])) {
    $location = htmlspecialchars($_GET['location']);

    // Fetch packages based on selected location
    try {
        $sql = "SELECT * FROM tbltourpackages WHERE PackageLocation = :location";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':location', $location, PDO::PARAM_STR);
        $stmt->execute();
        $packages = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($packages) {
            foreach ($packages as $package) {
                echo '<div class="rom-btm">';
                echo '<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">';
                echo '<img src="admin/pacakgeimages/' . htmlentities($package->PackageImage) . '" class="img-responsive" alt="">';
                echo '</div>';
                echo '<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">';
                echo '<h4>Package Name: ' . htmlentities($package->PackageName) . '</h4>';
                echo '<h6>Package Type: ' . htmlentities($package->PackageType) . '</h6>';
                echo '<p><b>Package Location:</b> ' . htmlentities($package->PackageLocation) . '</p>';
                echo '<p><b>Features:</b> ' . htmlentities($package->PackageFetures) . '</p>';
                echo '</div>';
                echo '<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">';
                echo '<h5>INR ' . htmlentities($package->PackagePrice) . '</h5>';
                echo '<a href="package-details.php?pkgid=' . htmlentities($package->PackageId) . '" class="view">Details</a>';
                echo '</div>';
                echo '<div class="clearfix"></div>';
                echo '</div>';
            }
        } else {
            echo '<p>No packages found for this location.</p>';
        }
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
} else {
    echo '<p>No location selected.</p>';
}
?>
