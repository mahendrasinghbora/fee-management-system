<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$userId = $_POST['userId'];
	$userType = $_POST['userType'];

	$con->query("UPDATE users SET USER_STATUS_ID = '$userType' WHERE USER_ID = '$userId';");

	$_SESSION['admin_message'] = "User's authority successfully changed!";
	header("Location: ../masters/add_users.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}

