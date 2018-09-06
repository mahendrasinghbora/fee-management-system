<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$fhName = $_POST['flexibleHeadName'];
	$fhDesc = $_POST['description'];
	$fhId = $_POST['flexibleId'];

	$con->query("UPDATE fee_flexible_heads SET FLEXIBLE_HEAD_NAME = '$fhName', DESCRIPTION = '$fhDesc' WHERE FLEXIBLE_HEAD_ID = '$fhId';");

	$_SESSION['flexible_head_message'] = "Flexible fee head successfully updated!";
	header("Location: ../masters/add_flexible_heads.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
