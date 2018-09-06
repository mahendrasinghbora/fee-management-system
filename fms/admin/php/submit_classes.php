<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';

	$className = $_POST['className'];
	$userid = $_SESSION['userid'];

	if (mysqli_num_rows($con->query("SELECT * FROM classes WHERE CLASS_NAME = '$className';")) != 0) {
        $_SESSION['admin_error_message'] = "Class already added!";
    }
    else {
    	$con->query("INSERT INTO classes (CLASS_NAME, USER_ID, STATUS) VALUES('$className', '$userid', '1');");
		$_SESSION['admin_message'] = "Class successfully added!";
    }

	header("Location: ../masters/add_classes.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
