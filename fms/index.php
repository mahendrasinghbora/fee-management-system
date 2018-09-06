<?php session_start();
define('my_site_path', 'http://localhost/fms');
$con = new mysqli('localhost', 'root', '', 'fms');
$sql = "SELECT * FROM sessions ORDER BY SESSION_ID DESC;";
$result = $con->query($sql);
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Homepage</title>
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

	<body class="p-0">
		<!-- intruder -->
		<?php require 'templates/intruder.php'; ?>
		<?php require 'templates/no_authority.php'; ?>
		<?php unset($_SESSION['noAuthority']); ?>
		<?php unset($_SESSION['intruder']); ?>
		<!-- /intruder -->

		<!-- jumbotron -->
		<div class="jumbotron jumbotron-fluid bg-dark text-light">
			<div class="container text-sm-center">
				<i class="fa fa-ravelry fa-5x" aria-hidden="true"></i>
		   		<h1>Fee Management System</h1>
		    	<p class="lead text-success"><q>Customized School Fee Management System</q> is an online Fee Management System that can be used by any school that wants to update their manual or existing automated fee system.</p>
			</div>
		</div><!-- /jumbotron -->

		<div class="container-fluid pt-4">
			<!-- main -->
			<div class="row">
				<div class="col-lg order-lg-2">
					<!-- login-error -->
					<?php if(isset($_SESSION['signinerror']) && $_SESSION['signinerror'] != ''){?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<span id="error" class="lead text-danger"><?php echo $_SESSION['signinerror']; ?></span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php session_unset($_SESSION['signinerror']); }?><!-- /login-error -->
					
					<p class="form-banner" style="background-color: #2C9676;">Sign in</p>
					
					
					<!-- login-form -->
					<form accept-charset="UTF-8" action="php/authenticate.php" method="post" class="px-3 py-3 form mb-3">
						<div class="form-group">
							<label for="userid">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="session">Select Session</label>
							<select class="form-control" id="session" name="session" required>
								<?php while($row = mysqli_fetch_array($result)){ ?>
                            		<option value="<?php echo $row['SESSION_ID'] ?>"><?php echo $row['SESSION_ID'] ?></option>
                        		<?php } ?>
							</select>
						</div>

						<div class="w-100 my-5"></div>
						
						<button type="submit" class="btn btn-success btn-block mb-4">Sign in</button>
					</form><!-- /login-form -->
				</div>

				<div class="col-lg-8 order-lg-1">
					<h2 class="mb-5">FMS- A complete solution to fee management</h2>
					<div class="container-fluid mb-5">
						<div class="row">
							<div class="col">
								<img class="my-1 mr-3 img-fluid float-left" src="img/click.svg" alt="click-svg" style="width: 20%;">
								<h3>Magical clicks</h3>
								<p class="lead">It is designed to facilitate the users (at more ease) with customized fee records related to every student in every session and overall fee history on a single click.</p>
							</div>
							<div class="w-100 my-3"></div>
							<div class="col">		
								<img class="my-1 mr-3 img-fluid float-left" src="img/flask.svg" alt="flask-svg" style="width: 20%;">
								<h3>Lots of customization</h3>
								<p class="lead">It can be easily customized as per the requirements of the school. Students can submit fee as per the convenience of the accounts department on mercy basis. Static fee heads (fee heads that are enforced on everyone) and flexible fee heads (applicable on individual students) can be added in every session (as per the requirement).</p>
								<p></p>
							</div>
							<div class="w-100 my-3"></div>
							<div class="col">		
								<img class="my-1 mr-3 img-fluid float-left" src="img/analysis.svg" alt="analysis-svg" style="width: 20%;">
								<h3>Better report generation</h3>
								<p class="lead">It can generate multiple reports for the management like fee date wise, student wise and class wise, already paid fee, fee head wise, etcetera. It can help to identify the defaulters (students that have not cleared their dues) on a single click.</p>
								<p></p>
							</div>
							<div class="w-100 my-3"></div>
							<div class="col">		
								<img class="my-1 mr-3 img-fluid float-left" src="img/badge.svg" alt="badge-svg" style="width: 20%;">
								<h3>Less paper, more efficiency</h3>
								<p class="lead">It reduces the amount of paper work involved in the manual fee management hence avoiding data redundancies and inconsistencies, thus making data storage more easy and efficient.</p>
								<p></p>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /main -->
			
			<footer>
				<?php require 'templates/footer.php'; ?>
			</footer>
		</div><!-- /container -->


		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- My scripts -->
		<script>        
			$(document).ready(function () {
				$('#intruderModal').modal('show');
				$('#noAuthorityModal').modal('show');
			});
		</script>
	</body>
</html>