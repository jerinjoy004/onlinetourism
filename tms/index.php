<?php
session_start();
error_reporting(0);
include ('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>HORIZON</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script
		type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/headerStyles.css" rel='stylesheet' type='text/css' />
	<link href="css/indexStyles.css" rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- Custom Theme files -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--animate-->


	<!--//end-animate-->
</head>

<body>
	<div class="bannerWrapper">
		<div class="headerWrap">
			<?php include ('includes/header.php'); ?>
		</div>
		<div class="banner ds bannerT">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s"
				style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Expand Your Horizon.
				Plan
				with Ease.</h1>
			<div class="overlay">
				<!-- Overlay -->
			</div>
		</div>
	</div>

	<div class="rupes container">
		<div>
			<div class="col-md-4 rupes-left wow fadeInDown animated detailsCard" data-wow-delay=".5s"
				style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
				<div class="rup-left">
					<a href="offers.html"><i class="fa fa-usd primaryColor"></i></a>
				</div>
				<div class="rup-rgt">
					<h3 class="primaryColor">UP TO INR. 5000 OFF</h3>
					<h4><a href="offers.html" >TRAVEL SMART</a></h4>

				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 rupes-left wow fadeInDown animated detailsCard" data-wow-delay=".5s"
				style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
				<div class="rup-left">
					<a href="offers.html"><i class="fa fa-h-square primaryColor"></i></a>
				</div>
				<div class="rup-rgt">
					<h3 class="primaryColor">UP TO 20% OFF</h3>
					<h4><a href="offers.html">ON HOTELS ACROSS WORLD</a></h4>

				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 rupes-left wow fadeInDown animated detailsCard" data-wow-delay=".5s"
				style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
				<div class="rup-left">
					<a href="offers.html"><i class="fa fa-mobile primaryColor"></i></a>
				</div>
				<div class="rup-rgt">
					<h3 class="primaryColor">FLAT INR. 5000 OFF</h3>
					<h4><a href="offers.html">APP OFFER</a></h4>

				</div>
				<div class="clearfix"></div>
			</div>

		</div>
	</div>
	<!--- /rupes ---->


	<!---holiday---->
	<div class="container">
		<div class="holiday">

			<h3>Recommended Packages</h3>

			<?php $sql = "SELECT * from tourpackages order by rand() limit 4";
			$query = $dbh->prepare($sql);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$cnt = 1;
			if ($query->rowCount() > 0) {
				foreach ($results as $result) { ?>
					<div class="rom-btm cardContainer">
						<div class="col-md-3 room-left wow fadeInLeft animated imgContainer" data-wow-delay=".5s">
							<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>"
								class="img-responsive img-fluid imgStyle" alt="">
						</div>
						<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
							<h4>Package Name: <?php echo htmlentities($result->PackageName); ?></h4>
							<h6>Package Type : <?php echo htmlentities($result->PackageType); ?></h6>
							<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation); ?></p>
							<p><b>Features</b> <?php echo htmlentities($result->PackageFetures); ?></p>
						</div>
						<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
							<h5>INR <?php echo htmlentities($result->PackagePrice); ?></h5>
							<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>"
								class="view roundBtn">Details</a>
						</div>
						<div class="clearfix"></div>
					</div>

				<?php }
			} ?>


			<div><a href="package-list.php" class="view roundBtn">View More Packages</a></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<!--- routes ---->
	<!-- <div class="routes">
		<div class="container routesContainer">
			<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
				<div class="rou-left">
					<a href="#"><i class="fa fa-list"></i></a>
				</div>
				<div class="rou-rgt wow fadeInDown animated" data-wow-delay=".5s">
					<h3>800</h3>
					<p>Enquiries</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 routes-left">
				<div class="rou-left">
					<a href="#"><i class="fa fa-user"></i></a>
				</div>
				<div class="rou-rgt">
					<h3>190</h3>
					<p>Regestered users</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
				<div class="rou-left">
					<a href="#"><i class="fa fa-ticket"></i></a>
				</div>
				<div class="rou-rgt">
					<h3>70+</h3>
					<p>Booking</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->

	<!-- signup -->
	<?php include ('includes/signup.php'); ?>
	<!-- //signu -->
	<!-- signin -->
	<?php include ('includes/signin.php'); ?>
	<!-- //signin -->
	<!-- write us -->
	<?php include ('includes/write-us.php'); ?>
	<!-- //write us -->
</body>

<?php include ('includes/footer.php'); ?>

</html>
