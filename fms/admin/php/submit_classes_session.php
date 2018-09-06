<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$sessionId = $_POST['sessionId'];
	$classId = $_POST['classId'];
	$userid = $_SESSION['userid'];

	$con->query("INSERT INTO classes_in_session (CLASS_ID, SESSION_ID, USER_ID, STATUS) VALUES('$classId', '$sessionId', '$userid', '1');");

	$_SESSION['admin_message'] = "Class successfully added to the session " . $sessionId . "!";
	header("Location: ../masters/add_classes_session.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
