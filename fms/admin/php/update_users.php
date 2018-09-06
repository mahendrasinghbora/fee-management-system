<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';
	$result = $con->query("SELECT * FROM users, user_status WHERE users.USER_STATUS_ID = user_status.USER_STATUS_ID;");
	$resultEdit = $con->query("SELECT * FROM users, user_status WHERE users.USER_STATUS_ID = user_status.USER_STATUS_ID AND USER_ID ='" . $_GET['userId'] . "';");
	$rowEdit = $resultEdit->fetch_assoc();
	$navBrand = "Change Users' Authority";
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Update users' authority</title>
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
			<?php require '../../templates/navbar.php'; ?>
		</header>

		<?php require '../../templates/admin_message.php'; ?>
		<?php unset($_SESSION['admin_message']); ?>
		<?php require '../../templates/admin_error_message.php'; ?>
		<?php unset($_SESSION['admin_error_message']); ?>

		<!-- container -->
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<!-- form -->
				<div class="col-lg-4 ml-sm-auto mt-3">
					<h3 class="form-banner" style="background-color: #2C9676;">Change Authority</h3>
					<form class="form px-3 py-3" action="../php/change_users.php" method="post">
						<div class="form-group">
							<label for="userID">User ID</label>
							<input type="text" class="form-control" id="userId" name="userId" value="<?php echo $rowEdit['USER_ID']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="firstName">First Name</label>
							<input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $rowEdit['FIRST_NAME']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="lastName">Last Name</label>
							<input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $rowEdit['LAST_NAME']; ?>" readonly>
						</div>
						<?php $resultUserType = $con->query("SELECT * FROM user_status;"); ?>
						<?php while ($rowUserType = $resultUserType->fetch_assoc()) { ?>
							<div class="form-group">
								<label for="userType" class="form-check-label">
									<input class="form-check-input" type="radio" value="<?php echo $rowUserType['USER_STATUS_ID']; ?>" id="userType" name="userType" required>
									<?php echo ucwords(strtolower($rowUserType['USER_TYPE']));?>
								</label>
							</div>
						<?php } ?>
						<button type="submit" class="btn btn-success btn-block">Update</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->

				<div class="col-lg-8 d-none d-sm-block ml-sm-auto mt-2">
					<table class="table table-bordered table-striped mt-3 bg-white table-sm">
						<caption class="lead">List of already added users.</caption>
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">User ID</th>
								<th scope="col">First Name</th>
								<th scope="col">Last Name</th>
								<th scope="col">User Type</th>
								<th scope="col">Update</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;   //For table indexing. ?>
							<?php while ($row = $result->fetch_assoc()){ ?>
								<?php if ($row['USER_ID'] == $_GET['userId']) { ?>
									<tr class="table-info">
								<?php } else {?>
									<tr>
									<?php } ?>
										<td><?php echo $i++; ?></td>
										<th scope="row"><?php echo $row['USER_ID']; ?></th>
										<td><?php echo $row['FIRST_NAME']; ?></td>
										<td><?php echo $row['LAST_NAME']; ?></td>
										<td><?php echo ucwords(strtolower($row['USER_TYPE'])); ?></td>
										<td><a href="../php/update_users.php?userId=<?php echo $row['USER_ID']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
										<td><a href="../php/delete_users.php?userId=<?php echo $row['USER_ID']; ?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
									</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="w-100 my-5"></div>

			
			<footer>
				<?php require '../../templates/footer.php'; ?>
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
    header("Location: ../../index.php");
}

