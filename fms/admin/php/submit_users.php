<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	define('my_site_path', 'http://localhost/fms');
	require '../../php/db_config.php';

	$userId = $_POST['userId'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$userType = $_POST['userType'];
	$userThumbnail = my_site_path . '/img/users/user.png';

	$bool = $con->query("INSERT INTO users (USER_ID, FIRST_NAME, LAST_NAME, USER_STATUS_ID, THUMBNAIL, PASSWORD, STATUS) VALUES ('$userId', '$firstName', '$lastName', '$userType', '$userThumbnail', '123456', '1');");

	if ($bool == false) {
		$_SESSION['admin_error_message'] = "User ID already in use!";	
	}
	else {
		$_SESSION['admin_message'] = "User successfully added!";	
	}

	header("Location: ../masters/add_users.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
