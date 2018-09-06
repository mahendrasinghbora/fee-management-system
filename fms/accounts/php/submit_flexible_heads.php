<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$fhName = $_POST['flexibleHeadName'];
	$fhDesc = $_POST['description'];
	$userid = $_SESSION['userid'];

	$con->query("INSERT INTO fee_flexible_heads (FLEXIBLE_HEAD_NAME, DESCRIPTION, USER_ID, STATUS) VALUES('$fhName', '$fhDesc', '$userid', '1');");

	$_SESSION['flexible_head_message'] = "Flexible fee head successfully added!";
	header("Location: ../masters/add_flexible_heads.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
