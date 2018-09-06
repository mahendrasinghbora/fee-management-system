<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'MANAGEMENT')) {
	$dashboardNavBrand = ucwords(strtolower($_SESSION['userstatus'])) . "'s Dashboard";
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Management's Dashboard</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<!-- shortcut-icon -->
		<link rel="shortcut icon" href="<?php echo my_site_path; ?>/img/favicon.png"><!-- /shortcut-icon -->
		<!-- custom-stylesheet -->
		<link rel="stylesheet" href="<?php echo my_site_path; ?>/css/main.css" type="text/css"><!-- /custom-stylesheet -->
		<!-- font-awesome-icons -->
		<link rel="stylesheet" href="<?php echo my_site_path; ?>/css/font-awesome/css/font-awesome.min.css"><!-- /font-awesome-icons -->
	</head>

	<body>
		<header>
			<?php require '../templates/dashboard_navbar.php'; ?>
		</header>

		<?php require '../templates/password_msg.php'; ?>
		<?php unset($_SESSION['passwordMessage']); ?>

		<!-- container -->
		<div class="container-fluid mt-5">
			<!-- row1 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
						<div class="card-deck">
					    	<div class="card text-center card-box">
					    		<a href="masters/view_static.php">
					    		<h3 class="card-banner" style="background-color: #2C9676;">View Static Heads</h3>
					    		<div class="card-body">
						        	<p class="card-text lead">View different staic fee heads that can be associated with the classes of the school.</p>
								</div>
								</a>
							</div>
						<div class="card text-center card-box">
							<a href="masters/view_flexible.php">
							<h3 class="card-banner" style="background-color: #2C9676;">View Flexible Heads</h3>
							<div class="card-body">
								<p class="card-text lead">View different flexible fee heads that can be associated with the students of the school.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/monthly_collection.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Monthly Fee Collection</h3>
							<div class="card-body">
								<p class="card-text lead">View the monthly fee collection.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row1 -->
			
			<div class="w-sm-100 my-sm-4"></div>

			<!-- row2 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
						<div class="card-deck">
					    	<div class="card text-center card-box">
					    		<a href="masters/classwise_collection.php">
					    		<h3 class="card-banner" style="background-color: #E15258;">Classwise Fee Collection</h3>
					    		<div class="card-body">
						        	<p class="card-text lead">View the classwise fee collection.</p>
								</div>
								</a>
							</div>
						<div class="card text-center card-box">
							<a href="masters/defaulters.php">
							<h3 class="card-banner" style="background-color: #E15258;">View Defaulters</h3>
							<div class="card-body">
								<p class="card-text lead">View the list of students who have not cleared their dues. The students with remaining dues are defaulters.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/view_log.php">
							<h3 class="card-banner" style="background-color: #E15258;">View Users' Log</h3>
							<div class="card-body">
								<p class="card-text lead">View users' log with log in and log out time.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row2 -->
			
			<div class="w-sm-100 my-sm-4"></div>

			<footer>
				<?php require '../templates/footer.php'; ?>
 			</footer>
 		</div><!-- /container -->

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script>        
			$(document).ready(function () {
				$('#addedModal').modal('show');
			});
		</script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'MANAGEMENT') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the management.";
    }
    header("Location: ../index.php");
}
