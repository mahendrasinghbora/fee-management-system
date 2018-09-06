<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	$dashboardNavBrand = ucwords(strtolower($_SESSION['userstatus'])) . "'s Dashboard";
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Admin's Dashboard</title>
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
					    		<a href="masters/add_users.php">
					    		<h3 class="card-banner" style="background-color: #2C9676;">Add Users</h3>
					    		<div class="card-body">
						        	<p class="card-text lead">Add new users to the FMS. A new user can be an admin or from the accounts department or even someone from the management.</p>
								</div>
								</a>
							</div>
						<div class="card text-center card-box">
							<a href="masters/add_users.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Change Users' Authority</h3>
							<div class="card-body">
								<p class="card-text lead">Change a user's authority. A user can be an admin or from the accounts department or even someone from the management.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_users.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Delete Users</h3>
							<div class="card-body">
								<p class="card-text lead">Delete an existing user.</p>
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
							<a href="masters/add_classes.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Add Classes</h3>
							<div class="card-body">
								<p class="card-text lead">Add new classes to the school.</p>
							</div>
							</a>
						</div>
				    	<div class="card text-center card-box">
							<a href="masters/add_classes_session.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Add Classes (Session Wise)</h3>
							<div class="card-body">
								<p class="card-text lead">Add new classes to a session. New classes to a session can only be added from the list of existing classes.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_classes.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Delete Classes</h3>
							<div class="card-body">
								<p class="card-text lead">Delete classes from the school.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row2 -->

			<div class="w-sm-100 my-sm-4"></div>

			<!-- row3 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
				    	<div class="card text-center card-box">
							<a href="masters/add_classes_session.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Delete Classes (Session Wise)</h3>
							<div class="card-body">
								<p class="card-text lead">Delete classes from a session.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_sessions.php">
							<h3 class="card-banner" style="background-color: #E15258;">Add Sessions</h3>
							<div class="card-body">
								<p class="card-text lead">Add new sessions (for example 2016-17, 2017-18, etcetera). A session generally starts from 1st of April and ends on 31st of March.</p>
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
			</div><!-- /row3 -->
			
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
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
