<?php if ($_SESSION['login']) { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="prnt"><a href="profile.php">My Profile</a></li>
				<li class="prnt"><a href="change-password.php">Change Password</a></li>
				<li class="prnt"><a href="tour-history.php">My Tour History</a></li>
				<li class="prnt"><a href="issuetickets.php">Issue Tickets</a></li>
			</ul>
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="tol">Welcome :</li>
				<li class="sig"><?php echo htmlentities($_SESSION['login']); ?></li>
				<li class="sigi"><a href="logout.php">/ Logout</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div><?php } else { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="hm"><a href="admin/index.php">Admin Login</a></li>
			</ul>
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
				<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4">/ Sign In</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>
<!--- /top-header ---->

<!-- TODO: Fix responsiveness -->
<!-- TODO: Move header to index -->

<!--- header ---->
<div class="header" style="background-color: transparent;">
	<div class="headerWrapper">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php"><span>HORIZON</span></a>
		</div>
		<div class="container navContainer">
			<div class="navigation">
				<nav class="navbar">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<nav class="cl-effect-1">
							<ul class="nav navbar-nav navbarContainer">
								<li><a href="index.php">Home</a></li>
								<li><a href="page.php?type=aboutus">About</a></li>
								<li><a href="package-list.php">Tour Packages</a></li>
								<li><a href="page.php?type=privacy">Privacy Policy</a></li>
								<li><a href="page.php?type=terms">Terms and Conditions</a></li>
								<li><a href="page.php?type=contact">Contact Us</a></li>
								<?php if ($_SESSION['login']) { ?>
									<li><a href="#" data-toggle="modal" data-target="#myModal3"> Need Help </a> </li>
								<?php } else { ?>
									<li><a href="enquiry.php"> Enquiry </a> </li>
								<?php } ?>
								<div class="clearfix"></div>

							</ul>
						</nav>
					</div>
				</nav>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--- /header ---->
