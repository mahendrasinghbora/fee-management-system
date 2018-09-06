<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$classId = $_GET['classId'];
	$sessionId = $_GET['sessionId'];
	
	$con->query("DELETE FROM classes_in_session WHERE CLASS_ID = '$classId' AND SESSION_ID = '$sessionId';");

	$_SESSION['admin_message'] = "Class successfully deleted from the session " . $sessionId . "!";
	header("Location: ../masters/add_classes_session.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
