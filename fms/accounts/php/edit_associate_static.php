<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$sessionId = $_SESSION['sessionId'];
	$staticHeadId = $_GET['staticId'];
	$classId = $_GET['classId'];
	$staticAmount = $_GET['staticAmount'];

	$result = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND SESSION_ID = '$sessionId' AND CLASS_SESSION_ID = '$classId';");

	$row = $result->fetch_assoc();
    $className = $row['CLASS_NAME'];

    $resultStatic = $con->query("SELECT STATIC_HEAD_ID, STATIC_HEAD_NAME FROM fee_static_heads WHERE STATIC_HEAD_ID = '$staticHeadId';");
    $rowStatic = $resultStatic->fetch_assoc();
    $staticHeadName = $rowStatic['STATIC_HEAD_NAME'];

	$navBrand = 'Edit Associated Fee Heads';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Edit Associated Static Fee Heads</title>
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

		<!-- container -->
		<div class="container-fluid">
			<div class="row pt-5">
				<!-- form -->
				<div class="col mx-auto px-auto" style="max-width: 500px;">
					<h3 class="form-banner" style="background-color: #C25975;">Edit Associated Static Heads</h3>
					<form class="form px-3 py-3" action="../php/update_associate_static.php" method="post">
						<div class="form-group">
							<label for="sessionId">Session</label>
							<input type="text" class="form-control" id="sessionId" name="sessionId" value="<?php echo $sessionId; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="classId">Class</label>
							<input type="text" class="form-control" id="classId" value="<?php echo $className; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="staticHeadId">Static Fee Head Name</label>
							<input type="text" class="form-control" id="staticHeadId" value="<?php echo $staticHeadName; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="staticHeadAmount">Static Fee Head Amount</label>
							<input type="text" class="form-control" id="staticHeadAmount" name="staticHeadAmount"  placeholder="<?php echo $staticAmount; ?>" required>
						</div>
						<input type="hidden" name="classId" value="<?php echo $classId; ?>">
						<input type="hidden" name="staticHeadId" value="<?php echo $staticHeadId; ?>">
						<button type="submit" class="btn btn-success btn-block">Update</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->
			</div>

			<div class="w-100 my-5"></div>
			
			<footer>
				<?php require '../../templates/footer.php'; ?>
			</footer>
 		</div><!-- /container -->

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}

