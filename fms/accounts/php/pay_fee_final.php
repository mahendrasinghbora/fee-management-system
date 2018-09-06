<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $sessionId = $_SESSION['sessionId'];
    $classId = $_GET['classId'];
    $studentId = $_GET['studentId'];
    $navBrand = 'Pay Fee';

    $resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");

    $rowClass = $resultClass->fetch_assoc();

    $resultStudent = $con->query("SELECT STUDENT_NAME, FATHER_NAME, ADDRESS, students.STUDENT_ID FROM class_wise_students, students WHERE class_wise_students.STUDENT_ID = students.STUDENT_ID AND CLASS_SESSION_ID = '$classId' AND students.STUDENT_ID = '$studentId';");

    $rowStudent = $resultStudent->fetch_assoc();

    $resultInvoice = $con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' AND CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;");

    $rowInvoice = $resultInvoice->fetch_assoc();
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Pay Fee</title>
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
		<div class="container-fluid px-3">
			<div class="row pt-5">
				<!-- form -->
				<div class="col ml-sm-auto">
					<form class="form px-3 py-3" action="../php/submit_fee.php" method="post">
						<div class="form-row">
							<div class="col">
								<div class="form-row">
									<div class="col">
										<div class="form-row">
											<div class="col">
												<label for="date">Date</label>
												<input type="text" class="form-control" id="date" name="date" readonly value="<?php echo date("d-m-Y"); ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="studentId">Student ID</label>
												<input type="text" class="form-control" id="studentId" name="studentId" readonly value="<?php echo $rowStudent['STUDENT_ID']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="studentName">Name of the Student</label>
												<input type="text" class="form-control" id="studentName" name="studentName" readonly value="<?php echo $rowStudent['STUDENT_NAME']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="className">Class</label>
												<input type="text" class="form-control" id="className" name="className" readonly value="<?php echo $rowClass['CLASS_NAME']; ?>">
												<input type="hidden" class="form-control" id="classId" name="classId" value="<?php echo $classId; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="sessionId">Session</label>
												<input type="text" class="form-control" id="sessionId" name="sessionId" readonly value="<?php echo $sessionId; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="fatherName">Father's Name</label>
												<input type="text" class="form-control" id="fatherName" name="fatherName" readonly value="<?php echo $rowStudent['FATHER_NAME']; ?>">
											</div>
										</div>
									</div>
									<div class="col ml-5">
										<div class="form-row">
											<div class="col">
												<label for="actualFee">Actual Fee (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="actualFee" name="actualFee" readonly value="<?php echo $rowInvoice['ACTUAL_AMOUNT']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="previousDues">Previous Dues (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="previousDues" name="previousDues" readonly value="<?php echo $rowInvoice['PREVIOUS_DUES']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="totalDue">Total Amount to be Paid (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="totalDue" name="totalDue" readonly value="<?php echo $rowInvoice['PREVIOUS_DUES'] + $rowInvoice['ACTUAL_AMOUNT']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="description">Description (if any)</label>
												<textarea class="form-control" id="description" name="description" rows="8"></textarea>
											</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-row">
									<div class="col ml-5 pl-5">
										<div class="form-row">
											<div class="col">
												<label for="pay">Pay Fee (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="pay" name="pay" required value="<?php echo $rowInvoice['PREVIOUS_DUES'] + $rowInvoice['ACTUAL_AMOUNT']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="discount">Discount (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="discount" name="discount" value="0">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="fine">Fine (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="fine" name="fine" value="0">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="totalAmount">Total Amount (in <i class="fa fa-inr" aria-hidden="true"></i>)</label>
												<input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly value="<?php echo $rowInvoice['PREVIOUS_DUES'] + $rowInvoice['ACTUAL_AMOUNT']; ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="col">
												<label for="paymentMode">Mode of Payment</label>
												<select class="form-control" id="paymentMode" name="paymentMode">
										            <option value="Cash">Cash</option>
										            <option value="Demand Draft">Demand Draft</option>
										            <option value="Cheque">Cheque</option>
												</select>
												<!-- draft -->
												<div id="mode"></div><!-- /draft -->
											</div>
										</div>
										<button type="submit" class="btn btn-success btn-block mt-5" style="max-width: 250px;"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Fee</button>
										<button type="reset" class="btn btn-info btn-block" style="max-width: 250px;">Reset</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- /form -->
			</div>

			<!-- students -->
			<div class="row mx-1 py-2 px-1" id="students"></div><!-- /students -->
			
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
				$("#paymentMode").change(function() {
					$.ajax({
						type: "post",
						url: "../php/draft_cheque.php",
						data: {
							"paymentMode": $("#paymentMode").val()
						},
						success: function(data) {
							$("#mode").html(data);
						}
					});
				});
				$("#pay").change(function() {
					$("#totalAmount").val(parseInt($("#pay").val()) + parseInt($("#discount").val()) - parseInt($("#fine").val()))
				});
				$("#discount").change(function() {
					$("#totalAmount").val(parseInt($("#pay").val()) + parseInt($("#discount").val()) - parseInt($("#fine").val()))
				});
				$("#fine").change(function() {
					$("#totalAmount").val(parseInt($("#pay").val()) + parseInt($("#discount").val()) - parseInt($("#fine").val()))
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
