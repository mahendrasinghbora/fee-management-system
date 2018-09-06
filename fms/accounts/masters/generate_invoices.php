<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$sessionId = $_SESSION['sessionId'];
	$result = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND SESSION_ID = '$sessionId';");
	$yearFrom = substr($sessionId, 0, 4);
	$yearTo = $yearFrom + 1;
	$navBrand = 'Generate Invoices';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Generate Invoices</title>
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

		<?php
		if (mysqli_num_rows($con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND SESSION_ID = '$sessionId';")) == 0) {
			require '../php/no_classes.php';
		} else { ?>
		

		<!-- container -->
		<div class="container-fluid px-3">
			<div class="row pt-5">
				<!-- form -->
				<div class="col">
					<form class="form px-3 py-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<div class="form-row">
							<div class="col">
								<label for="classId">Select Class</label>
								<select class="form-control" id="classId" name="classId">
									<?php while ($row = $result->fetch_assoc()) { ?>
										<option value="<?php echo $row["CLASS_SESSION_ID"]; ?>"><?php echo $row["CLASS_NAME"]; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col">
								<label for="monthFrom">Month From</label>
								<select class="form-control" name="monthFrom" id="monthFrom">
								    <?php
								    $months = array("April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March");
								    $i = 1;   //For indexing.
								    foreach ($months as $month) { ?>
								        <option value="<?php echo $i++; ?>"><?php echo $month; ?></option>
								    <?php } ?>
								</select>
							</div>
							<div class="col">
								<label for="yearFrom">Year From</label>
								<input type="text" class="form-control" id="yearFrom" name="yearFrom" value="<?php echo $yearFrom; ?>" readonly>
							</div>
							<div class="col">
								<label for="monthTo">Month To</label>
								<select class="form-control" name="monthTo" id="monthTo">
								    <?php
								    $months = array("April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March");
								    $i = 1;   //For indexing.
								    foreach ($months as $month) { ?>
								        <option value="<?php echo $i++; ?>"><?php echo $month; ?></option>
								    <?php } ?>
								</select>
							</div>
							<div class="col">
								<label for="yearTo">Year To</label>
								<input type="text" class="form-control" id="yearTo" name="yearTo" value="<?php echo $yearTo; ?>" readonly>
							</div>
						</div>
					</form>
				</div><!-- /form -->
			</div>

			<!-- lastDate -->
			<div class="row mx-1 py-2 px-3" id="lastDate"></div><!-- /lastDate -->
			
			<!-- invoiceTemplate -->
			<div class="row mx-1 py-2" id="invoiceTemplate"></div><!-- /invoiceTemplate -->
			
			<div class="w-100 my-2"></div>

			<!-- invoices -->
			<div class="row mx-1 py-2 px-1" id="invoices"></div><!-- /invoices -->

			<footer>
				<?php require '../../templates/footer.php'; ?>
			</footer>
 		</div><!-- /container -->
		
		<?php } ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- my-script -->
		<script>        
			$(document).ready(function () {
				$('#noClassModal').modal('show');
				$("#classId").change(function() {
					$.ajax({
						type: "post",
						url: "../php/invoice_template.php",
						data: {
							"classId": $("#classId").val()
						},
						success: function(data) {
							$("#invoiceTemplate").html(data);
						}
					});
				});	
				$("#classId").change(function() {
					$.ajax({
						type: "post",
						url: "../php/last_date.php",
						data: {
							"classId": $("#classId").val()
						},
						success: function(data) {
							$("#lastDate").html(data);
						}
					});
				});	
				$("#classId").change(function() {
					$.ajax({
						type: "post",
						url: "../php/invoices.php",
						data: {
							"classId": $("#classId").val()
						},
						success: function(data) {
							$("#invoices").html(data);
						}
					});
				});
				var $yearFrom = parseInt($("#yearFrom").val());   // To store year from.
				var $yearTo = parseInt($("#yearTo").val());   // To store year to.
				$("#monthFrom").change(function() {
					if ($("#monthFrom").val() > 9) {
						$("#yearFrom").val($yearFrom + 1);
					}
					else {
						$("#yearFrom").val($yearFrom);
					}
					if (($("#monthTo").val() > 9) || ($("#monthTo").val() == 1)) {
						$("#yearTo").val($yearTo);
					}
					else {
						$("#yearTo").val($yearTo - 1);
					}
				});	
				$("#monthTo").change(function() {
					if (($("#monthTo").val() > 9) || ($("#monthTo").val() == 1)) {
						$("#yearTo").val($yearTo);
					}
					else {
						$("#yearTo").val($yearTo - 1);
					}
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

