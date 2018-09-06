<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';
	$navBrand = 'Print Receipts';
	$sessionId = $_SESSION['sessionId'];
	
	$receiptId = $_GET['receiptId'];
	$studentId = $_GET['studentId'];
	$className = $_GET['className'];
	$studentName = $_GET['studentName'];
	$fatherName = $_GET['fatherName'];
	$paymentMode = $_GET['paymentMode'];
	$totalAmount = $_GET['totalAmount'];
	$draftNumber = $_GET['draftNumber'];
	$draftDate = $_GET['draftDate'];
	$staticHeads = $_GET['staticHeads'];
	$flexibleHeads = $_GET['flexibleHeads'];
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Print Receipts</title>
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

		<button class="btn btn-success btn-lg mb-3 mx-5 mt-5" id="printReceiptStudent"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Print Receipt (Student's Copy)</button>
		<button class="btn btn-success btn-lg mb-3 mt-5" id="printReceiptOffice"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Print Receipt (Office Copy)</button>
		<!-- container -->
		<div class="container-fluid px-5" id="student">
			<div class="row bg-white border rounded-top border-dark">
				<div class="col text-center fa-2x">
					<i class="fa fa-ravelry" aria-hidden="true"></i>
					<h3>Fee Management System</h3>
        		</div>
			</div>
			<div class="row border border-dark bg-white">
	            <div class="col text-center">
	                <h2 class="mb-0">RECEIPT</h2>
	                <h2 class="mb-0">(Student's Copy)</h2>
	                <strong><?php echo date('F, Y'); ?></strong>
	            </div>
	        </div>
			<div class="row border border-dark bg-white">
	            <div class="col text-left">
	                <?php echo "<strong>Receipt ID: </strong>" . $receiptId; ?>
	            </div>
	            <div class="col text-right">
	            	<?php echo "<strong>Date: </strong>" . date('d-m-Y'); ?>
	            </div>
	        </div>
			<div class="row border border-dark bg-white">
				<div class="col text-left">
					<?php echo "<strong>Student ID: </strong>" . $studentId; ?><br>
					<?php echo "<strong>Student Name: </strong>" . $studentName; ?><br>
					<?php echo "<strong>Father's Name: </strong>" . $fatherName; ?><br>
					<?php echo "<strong>Class: </strong>" . $className; ?><br>
					<?php echo "<strong>Session: </strong>" . $sessionId; ?>
				</div>
				<div class="col text-left">
					<?php echo "<strong>Date of Submission: </strong>" . date('d-m-Y'); ?><br>
					<?php echo "<strong>Static Fee Heads: </strong>" . $staticHeads; ?><br>
					<?php echo "<strong>Flexible Fee Heads: </strong>" . $flexibleHeads; ?><br>
					<?php echo "<strong>Mode of payment: </strong>" . $paymentMode; ?><br>
					<?php echo "<strong>Draft/Cheque Number: </strong>" . $draftNumber; ?><br>
					<?php echo "<strong>Draft/Cheque Date: </strong>" . $draftDate; ?><br>
					<?php
					$inWords = new NumberFormatter("en", NumberFormatter::SPELLOUT);
					?>
					<?php echo "<strong>Total Amount Paid (in <i class='fa fa-inr' aria-hidden='true'></i>): </strong>" . $totalAmount . " (" .  ucfirst($inWords->format($totalAmount)) . ")."; ?>
				</div>
			</div>
			<div class="row border border-dark bg-white">
				<div class="col text-right" style="min-height: 100px;">
					<h3>Authorized Signatory</h3>
				</div>
			</div>
		</div>
				
		<!-- container -->
		<div class="container-fluid px-5 mt-3" id="office">
			<div class="row bg-white border rounded-top border-dark">
				<div class="col text-center fa-2x">
					<i class="fa fa-ravelry" aria-hidden="true"></i>
					<h3>Fee Management System</h3>
        		</div>
			</div>
			<div class="row border border-dark bg-white">
	            <div class="col text-center">
	                <h2 class="mb-0">RECEIPT</h2>
	                <h2 class="mb-0">(Office Copy)</h2>
	                <strong><?php echo date('F, Y'); ?></strong>
	            </div>
	        </div>
			<div class="row border border-dark bg-white">
	            <div class="col text-left">
	                <?php echo "<strong>Receipt ID: </strong>" . $receiptId; ?>
	            </div>
	            <div class="col text-right">
	            	<?php echo "<strong>Date: </strong>" . date('d-m-Y'); ?>
	            </div>
	        </div>
			<div class="row border border-dark bg-white">
				<div class="col text-left">
					<?php echo "<strong>Student ID: </strong>" . $studentId; ?><br>
					<?php echo "<strong>Student Name: </strong>" . $studentName; ?><br>
					<?php echo "<strong>Father's Name: </strong>" . $fatherName; ?><br>
					<?php echo "<strong>Class: </strong>" . $className; ?><br>
					<?php echo "<strong>Session: </strong>" . $sessionId; ?>
				</div>
				<div class="col text-left">
					<?php echo "<strong>Date of Submission: </strong>" . date('d-m-Y'); ?><br>
					<?php echo "<strong>Static Fee Heads: </strong>" . $staticHeads; ?><br>
					<?php echo "<strong>Flexible Fee Heads: </strong>" . $flexibleHeads; ?><br>
					<?php echo "<strong>Mode of payment: </strong>" . $paymentMode; ?><br>
					<?php echo "<strong>Draft/Cheque Number: </strong>" . $draftNumber; ?><br>
					<?php echo "<strong>Draft/Cheque Date: </strong>" . $draftDate; ?><br>
					<?php
					$inWords = new NumberFormatter("en", NumberFormatter::SPELLOUT);
					?>
					<?php echo "<strong>Total Amount Paid (in <i class='fa fa-inr' aria-hidden='true'></i>): </strong>" . $totalAmount . " (" .  ucfirst($inWords->format($totalAmount)) . ")."; ?>
				</div>
			</div>
			<div class="row border border-dark bg-white">
				<div class="col text-right" style="min-height: 100px;">
					<h3>Authorized Signatory</h3>
				</div>
			</div>
 		</div><!-- /container -->
 		<footer>
			<?php require '../../templates/footer.php'; ?>
		</footer>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- my-script -->
		<script src="<?php echo my_site_path; ?>/js/printThis.js"></script>
		<script>        
			$(document).ready(function () {
				$("#printReceiptOffice").click(function() {
		            $('#office').printThis();
		        });
		        $("#printReceiptStudent").click(function() {
		            $('#student').printThis();
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
