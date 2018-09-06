<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {

	$paymentMode  = $_POST['paymentMode'];

	if ($paymentMode != 'Cash') { ?>
		<label for="draftNumber">Draft/Cheque Number</label>
		<input type="text" class="form-control" id="draftNumber" name="draftNumber" required>
		<label for="draftDate">Draft/Cheque Date</label>
		<input type="date" class="form-control" id="draftDate" name="draftDate" required>
	<?php } ?>


<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
