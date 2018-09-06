<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$flexibleHeadId = $_GET['flexibleId'];
	$studentId = $_GET['studentId'];
	$flexibleAmount = $_GET['flexibleAmount'];

	$result = $con->query("SELECT STUDENT_NAME, STUDENT_ID FROM students WHERE  STUDENT_ID = '$studentId';");

	$row = $result->fetch_assoc();
    $studentName = $row['STUDENT_NAME'];
    $resultFlexible = $con->query("SELECT FLEXIBLE_HEAD_ID, FLEXIBLE_HEAD_NAME FROM fee_flexible_heads WHERE FLEXIBLE_HEAD_ID = '$flexibleHeadId';");
    $rowFlexible = $resultFlexible->fetch_assoc();
    $flexibleHeadName = $rowFlexible['FLEXIBLE_HEAD_NAME'];

	$navBrand = 'Edit Associated Fee Heads';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Edit Associated Flexible Fee Heads</title>
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
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<!-- form -->
				<div class="col mx-auto px-auto" style="max-width: 500px;">
					<h3 class="form-banner" style="background-color: #7D669E;">Edit Associated Flexible Heads</h3>
					<form class="form px-3 py-3" action="../php/update_associate_flexible.php" method="post">
						<div class="form-group">
							<label for="studentId">Student Id</label>
							<input type="text" class="form-control" id="studentId" value="<?php echo $studentId; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="studentName">Student Name</label>
							<input type="text" class="form-control" id="studentName" value="<?php echo $studentName; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="flexibleHeadId">Flexible Fee Head Name</label>
							<input type="text" class="form-control" id="flexibleHeadId" value="<?php echo $flexibleHeadName; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="flexibleHeadAmount">Flexible Fee Head Amount</label>
							<input type="text" class="form-control" id="flexibleHeadAmount" name="flexibleHeadAmount"  placeholder="<?php echo $flexibleAmount; ?>" required>
						</div>
						<input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
						<input type="hidden" name="flexibleHeadId" value="<?php echo $flexibleHeadId; ?>">
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

