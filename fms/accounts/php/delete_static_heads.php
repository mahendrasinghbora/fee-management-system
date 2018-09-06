<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$shId = $_GET['staticId'];

	$con->query("DELETE FROM fee_static_heads WHERE STATIC_HEAD_ID = $shId;");

	$_SESSION['static_head_message'] = "Static fee head successfully deleted!";
	header("Location: ../masters/add_static_heads.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
