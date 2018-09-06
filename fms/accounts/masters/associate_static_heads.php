<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';
	$sessionId = $_SESSION['sessionId'];
	$result = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND SESSION_ID = '$sessionId';");
    $resultStatic = $con->query("SELECT STATIC_HEAD_ID, STATIC_HEAD_NAME FROM fee_static_heads;");
	$navBrand = 'Associate Static Heads';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Associate Static Fee Heads</title>
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

		<?php require '../../templates/static_error_message.php'; ?>
		<?php unset($_SESSION['static_error_message']); ?>
		<?php require '../../templates/static_head_message.php'; ?>
		<?php unset($_SESSION['static_head_message']); ?>
				
		<!-- container -->
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<!-- form -->
				<div class="col-lg-4 ml-sm-auto">
					<h3 class="form-banner" style="background-color: #C25975;">Associate Static Heads</h3>
					<form class="px-3 py-3 form" action="../php/associate_static.php" method="post">
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
						<div class="form-group">
							<label for="staticHeadId">Select Static Fee Head</label>
							<select class="form-control" id="staticHeadId" name="staticHeadId">
								<?php while ($row = $resultStatic->fetch_assoc()) { ?>
						            <option value="<?php echo $row["STATIC_HEAD_ID"]; ?>"><?php echo $row["STATIC_HEAD_NAME"]; ?></option>
						        <?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="staticHeadAmount">Static Fee Head Amount</label>
							<input type="text" class="form-control" id="staticHeadAmount" name="staticHeadAmount"  placeholder="Enter static fee head amount" required>
						</div>
						<button type="submit" class="btn btn-success btn-block">Associate</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->
				
				<!-- already-associated -->
				<div class="col-lg-8 d-none d-sm-block ml-sm-auto mt-2" id="staticTemplate"></div><!-- /already-associated -->
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
		<script>        
			$(document).ready(function () {
				$('#addedModal').modal('show');
				$("#classId").change(function() {
					$.ajax({
						type: "post",
						url: "../php/static_template.php",
						data: {
							"classId": $("#classId").val()
						},
						success: function(data) {
							$("#staticTemplate").html(data);
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

