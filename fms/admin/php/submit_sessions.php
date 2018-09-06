<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$userid = $_SESSION['userid'];
	$sessionStart  = $_POST['sessionStart'];
	$sessionEnd = $_POST['sessionEnd'];
	$sessionId = $sessionStart . "-" . substr($sessionEnd, 2);
	$startDate = "01-04-" . $sessionStart;
	$endDate = "31-03-" . $sessionEnd;

	if (mysqli_num_rows($con->query("SELECT * FROM sessions WHERE SESSION_ID = '$sessionId';")) != 0) {
        $_SESSION['admin_error_message'] = "Session already added!";
    }
    else {
    	$con->query("INSERT INTO sessions (SESSION_ID, START_DATE, END_DATE, USER_ID, STATUS) VALUES('$sessionId', '$startDate', '$endDate', '$userid', '1');");
		$_SESSION['admin_message'] = "Session successfully added!";
    }

	header("Location: ../masters/add_sessions.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
