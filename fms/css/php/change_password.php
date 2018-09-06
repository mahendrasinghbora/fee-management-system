<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid'])) {
	$navBrand = 'Change Password';
	$con = new mysqli('localhost', 'root', '', 'fms');
	$userid = $_SESSION['userid'];
	$result = $con->query("SELECT * FROM users WHERE USER_ID = '$userid';");
	$row = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Change Password</title>
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
			<?php require '../templates/navbar.php'; ?>
		</header>

		<!-- container -->
		<div class="container-fluid">
			<div class="row pt-5">
				<!-- form -->
				<div class="col mx-auto px-auto" style="max-width: 500px;">
					<!-- change-error -->
					<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ''){?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<span id="error" class="lead text-danger"><?php echo $_SESSION['error']; ?></span>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php unset($_SESSION['error']); }?><!-- /change-error -->
					<h3 class="form-banner" style="background-color: #C25975;">Change Password</h3>
					<form class="form px-3 py-3" action="update_password.php" method="post">
						<div class="form-group">
							<label for="userid">User ID</label>
							<input type="text" class="form-control" id="userid" name="userid" value="<?php echo $userid; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="currentPassword">Old Password</label>
							<input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
						</div>
						<div class="form-group">
							<label for="newPassword">New Password</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" required>
						</div>
						<div class="form-group">
							<label for="repeatPassword">Confirm New Password</label>
							<input type="password" class="form-control" id="repeatPassword" name="repeatPassword" required>
						</div>
						<button type="submit" class="btn btn-success btn-block" id="changePassword">Change Password</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->
			</div>

			<div class="w-100 my-5"></div>
			
			<footer>
				<?php require '../templates/footer.php'; ?>
			</footer>
 		</div><!-- /container -->

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- My scripts -->
		<script>        
			$(document).ready(function () {
				$('#intruderModal').modal('show');
			});
		</script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    header("Location: " . my_site_path . "/index.php");
}