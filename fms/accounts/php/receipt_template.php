<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $receiptId = $_POST['receiptId'];
    $sessionId = $_SESSION['sessionId'];
    "SELECT * FROM receipts WHERE RECEIPT_ID = '$receiptId';";
    $result = $con->query("SELECT * FROM receipts WHERE RECEIPT_ID = '$receiptId';");
    if (mysqli_num_rows($result) == 0) { ?>
    	<div class="modal fade" id="noReceiptModal" tabindex="-1" role="dialog" aria-labelledby="noReceiptModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">No Receipts alert!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>There is no receipt with this ID. Please check the receipt ID.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>        
            $(document).ready(function () {
                $('#noReceiptModal').modal('show');
            });
        </script>

    <?php } else { 
    	$row = $result->fetch_assoc();
    	$studentId = $row['STUDENT_ID'];
    	$classId = $row['CLASS_SESSION_ID'];

    	$resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");
		$rowClass = $resultClass->fetch_assoc();

		$className = $rowClass['CLASS_NAME'];

		$resultStudent = $con->query("SELECT * FROM students WHERE STUDENT_ID = '$studentId';");
		$rowStudent = $resultStudent->fetch_assoc();
		$studentName = $rowStudent['STUDENT_NAME'];
		$fatherName = $rowStudent['FATHER_NAME'];
		$paymentMode = $row['MODE_OF_PAYMENT'];
		$draftNumber = $row['DD_CHEQUE_NUMBER'];
		$draftDate = $row['DD_CHEQUE_DATE'];
		$flexibleHeads = $row['FLEXIBLE_HEADS'];
		$staticHeads = $row['STATIC_HEADS'];
		$totalAmount = $row['ACTUAL_PAID_AMOUNT'];
		$dateSubmission = substr($row['DATE_'], 0, 10); ?>

		<button class="btn btn-success btn-lg mb-3 mx-5" id="printReceiptStudent"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Print Receipt (Student's Copy)</button>
		<button class="btn btn-success btn-lg mb-3" id="printReceiptOffice"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Print Receipt (Office Copy)</button>
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
					<?php echo "<strong>Date of Submission: </strong>" . $dateSubmission; ?><br>
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
					<?php echo "<strong>Date of Submission: </strong>" . $dateSubmission; ?><br>
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
	<?php } ?>	
<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
