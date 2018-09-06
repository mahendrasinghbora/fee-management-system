<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';
	$sessionId = $_SESSION['sessionId'];
	$result = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND SESSION_ID = '$sessionId';");
    $resultFlexible = $con->query("SELECT FLEXIBLE_HEAD_ID, FLEXIBLE_HEAD_NAME FROM fee_flexible_heads;");
	$navBrand = 'Associate Flexible Heads';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Associate Flexible Fee Heads</title>
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

		<?php require '../../templates/flexible_error_message.php'; ?>
		<?php unset($_SESSION['flexible_error_message']); ?>
		<?php require '../../templates/flexible_head_message.php'; ?>
		<?php unset($_SESSION['flexible_head_message']); ?>
				
		<!-- container -->
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<!-- form -->
				<div class="col-lg-4 ml-sm-auto">
					<h3 class="form-banner" style="background-color: #7D669E;">Associate Flexible Heads</h3>
					<form class="form px-3 py-3" action="../php/associate_flexible.php" method="post">
						<div class="form-group">
							<label for="sessionId">Session</label>
							<input type="text" class="form-control" id="sessionId" name="sessionId" readonly value="<?php echo $sessionId; ?>">
						</div>
						<div class="form-group">
							<label for="classId">Select Class</label>
							<select class="form-control" id="classId" name="classId">
								<?php while ($row = $result->fetch_assoc()) { ?>
						            <option value="<?php echo $row["CLASS_SESSION_ID"]; ?>"><?php echo $row["CLASS_NAME"]; ?></option>
						        <?php } ?>
							</select>
						</div>
						<!-- students -->
						<div class="form-group" id="students"></div><!-- /students -->
						<div class="form-group">
							<label for="flexibleHeadId">Select Flexible Fee Head</label>
							<select class="form-control" id="flexibleHeadId" name="flexibleHeadId">
								<?php while ($row = $resultFlexible->fetch_assoc()) { ?>
						            <option value="<?php echo $row["FLEXIBLE_HEAD_ID"]; ?>"><?php echo $row["FLEXIBLE_HEAD_NAME"]; ?></option>
						        <?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="flexibleHeadAmount">Flexible Fee Head Amount</label>
							<input type="text" class="form-control" id="flexibleHeadAmount" name="flexibleHeadAmount"  placeholder="Enter flexible fee head Amount" required>
						</div>
						<button type="submit" class="btn btn-success btn-block">Associate</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->

				<!-- already-associated -->
				<div class="col-lg-8 d-none d-sm-block ml-sm-auto mt-2" id="flexibleTemplate"></div><!-- /already-associated -->
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

		<!-- my-script -->
		<script>        
			$(document).ready(function () {
				$('#addedModal').modal('show');
				$("#classId").change(function() {
					$.ajax({
						type: "post",
						url: "../php/student_template.php",
						data: {
							"classId": $("#classId").val()
						},
						success: function(data) {
							$("#students").html(data);
						}
					});
				});		
			});
		</script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}

