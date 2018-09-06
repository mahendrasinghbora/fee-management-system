<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid'])) {
	$image = $_SESSION['thumbnail'];
	$navBrand = 'Edit Profile';
	$con = new mysqli('localhost', 'root', '', 'fms');
	$userid = $_SESSION['userid'];
	$result = $con->query("SELECT * FROM users WHERE USER_ID = '$userid';");
	$row = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Edit Profile</title>
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

	<body class="p-0" style="min-width: 800px;">
		<header>
			<?php require '../templates/navbar.php'; ?>
		</header>

		<!-- intruder -->
		<?php require '../templates/intruder.php'; ?>
		<?php unset($_SESSION['intruder']); ?>
		<!-- /intruder -->

		<div class="container-fluid mt-5 px-md-5">
			<div class="row pt-5 px-5 mx-5">
				<div class="col px-5 mx-5">
					<h3 class="form-banner" style="background-color: #53BBB4;">Edit Profile</h3>
					<form accept-charset="UTF-8" action="profile_edit_performer.php" method="post" class="px-5 py-3 form mb-3" enctype = "multipart/form-data">
						<div class="form-row">
							<!-- thumbnail -->
							<div class="col mx-3">
								<!-- change-error -->
								<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ''){?>
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<span id="error" class="lead text-danger"><?php echo $_SESSION['error']; ?></span>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php unset($_SESSION['error']); }?><!-- /change-error -->
								<div class="form-row">
									<img src="<?php echo $image; ?>" alt="User's Thumbnail" class="img-fluid" style="max-height: 200px; max-width: 200px;">
								</div>
								<div class="form-group">
									<label for="userThumbnail">Select user's thumbnail</label>
									<input type="file" class="form-control-file" id="userThumbnail" name="userThumbnail">
								</div>
								<div class="form-row">
									<button class="btn btn-warning btn-lg mt-5" id="changePassword">Change Password</button>
								</div>
							</div><!-- /thumbnail -->
							<div class="col">
								<div class="form-row">
									<div class="col">
										<div class="form-row">
											<label for="userid">User ID</label>
											<input type="text" class="form-control" id="userid" name="userid" value="<?php echo $row['USER_ID']; ?>" readonly>
											<label for="firstName">First Name</label>
											<input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['FIRST_NAME']; ?>">
											<label for="lastName">Last Name</label>
											<input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['LAST_NAME']; ?>">
											<label for="password">Password</label>
											<input type="password" class="form-control" id="password" name="password" required>
											<input type="submit" name="submitImage" class="btn btn-success btn-lg mt-5" value="Save Changes">
											<button type="reset" class="btn btn-info btn-lg mt-5 ml-2">Reset</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			
			<footer>
				<?php require '../templates/footer.php'; ?>
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
				$('#changePassword').click(function () {
					$(location).attr('href', 'change_password.php')
				});
			});
		</script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    header("Location: " . my_site_path . "/index.php");
}