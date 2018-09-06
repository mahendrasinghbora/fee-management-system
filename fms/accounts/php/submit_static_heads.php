<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$shName = $_POST['staticHeadName'];
	$shDesc = $_POST['description'];
	$userid = $_SESSION['userid'];

	$con->query("INSERT INTO fee_static_heads (STATIC_HEAD_NAME, DESCRIPTION, USER_ID, STATUS) VALUES('$shName', '$shDesc', '$userid', '1');");

	$_SESSION['static_head_message'] = "Static fee head successfully added!";
	header("Location: ../masters/add_static_heads.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
