<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';
	$sessionId = $_SESSION['sessionId'];
	$userid = $_SESSION['userid'];
	
	$studentId = $_POST['studentId'];
	$classId = $_POST['classId'];
    $className = $_POST['className'];
	
	$studentName = $_POST['studentName'];
	$fatherName = $_POST['fatherName'];
	$studentName = $_POST['studentName'];
	
	$totalAmount = $_POST['totalAmount'];
	$paymentMode = $_POST['paymentMode'];
	
	if ($paymentMode != 'Cash') {
		$draftNumber = $_POST['draftNumber'];
		$draftDate = $_POST['draftDate'];
	}
	else {
		$draftNumber = '-';
		$draftDate = '-';	
	}
	
	$discount = $_POST['discount'];
	$discountStatus = ($discount != 0) ? 'Yes' : 'No';

	$fine = $_POST['fine'];
	$fineStatus = ($fine != 0) ? 'Yes' : 'No';

	$description = $_POST['description'];
	if ($description == '') {
		$description = '-';
	}

	$resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = '$classId';");

    $rowClass = $resultClass->fetch_assoc();

    $resultInvoice = $con->query("SELECT * FROM invoices WHERE STUDENT_ID = '$studentId' AND CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;");

    $rowInvoice = $resultInvoice->fetch_assoc();

    $staticHeads = $rowInvoice['STATIC_HEADS'];
    $flexibleHeads = $rowInvoice['FLEXIBLE_HEADS'];
    $invoiceId = $rowInvoice['INVOICE_ID'];
    $flexibleAmount = $rowInvoice['FLEXIBLE_SPLIT_AMOUNT'];
    $staticAmount = $rowInvoice['STATIC_SPLIT_AMOUNT'];
    $actualAmount = $rowInvoice['ACTUAL_AMOUNT'];
    $monthFromName = $rowInvoice['MONTH_FROM'];
    $monthToName = $rowInvoice['MONTH_TO'];
    $yearFrom = $rowInvoice['YEAR_FROM'];
    $yearTo = $rowInvoice['YEAR_TO'];
    $diffMonth = $rowInvoice['NUMBER_OF_MONTHS'];
    $previousDues = $rowInvoice['PREVIOUS_DUES'];

    // Calculate new dues.
    if (($totalAmount) == ($actualAmount + $previousDues)) {
    	$actualAmount = 0;
    	$previousDues = 0;
    }
    else {
    	if ($totalAmount > $actualAmount) {
    		$extra = $totalAmount - $actualAmount;
    		$actualAmount = 0;
    		$previousDues = $previousDues - $extra;
    	}
    	else {
    		$actualAmount = $actualAmount - $totalAmount;
    	}
    }


    if ($previousDues == 0) {
    	$descriptionInvoice = 'No dues.';
    }
    else {
    	$descriptionInvoice = 'Remaining dues.';
    }
    // Generate receipt.
    $con->query("INSERT INTO receipts (INVOICE_ID, STUDENT_ID, CLASS_SESSION_ID, STATIC_HEADS, FLEXIBLE_HEADS, DISCOUNT, DISCOUNT_AMOUNT, FINE, FINE_AMOUNT, ACTUAL_PAID_AMOUNT, MODE_OF_PAYMENT, DD_CHEQUE_NUMBER, DD_CHEQUE_DATE, DESCRIPTION, USER_ID, STATUS) VALUES ('$invoiceId', '$studentId', '$classId', '$staticHeads', '$flexibleHeads', '$discountStatus', '$discount', '$fineStatus', '$fine', '$totalAmount', '$paymentMode', '$draftNumber', '$draftDate', '$description', '$userid', '1');");

    // Modify invoice.
    $con->query("UPDATE invoices SET ACTUAL_AMOUNT = '$actualAmount', PREVIOUS_DUES = '$previousDues', DESCRIPTION = '$description', USER_ID = '$userid' WHERE INVOICE_ID = '$invoiceId';"); 

    $resultReceipt = $con->query("SELECT RECEIPT_ID FROM receipts WHERE INVOICE_ID = '$invoiceId' AND ACTUAL_PAID_AMOUNT = '$totalAmount';");
    
    $rowReceipt = $resultReceipt->fetch_assoc();
    $receiptId = $rowReceipt['RECEIPT_ID'];

    header("Location: ../php/print_receipt.php?receiptId=$receiptId&studentId=$studentId&className=$className&studentName=$studentName&fatherName=$fatherName&paymentMode=$paymentMode&totalAmount=$totalAmount&draftNumber=$draftNumber&draftDate=$draftDate&staticHeads=$staticHeads&flexibleHeads=$flexibleHeads");
?>


<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
