<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {

	require '../../php/db_config.php';

	$className = $_POST['className'];
	$classId = $_POST['classId'];

	$con->query("UPDATE classes SET CLASS_NAME = '$className' WHERE CLASS_ID = '$classId';");

	$_SESSION['admin_message'] = "Class successfully updated!";
	header("Location: ../masters/add_classes.php");
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}
