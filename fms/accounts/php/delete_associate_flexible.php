<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$flexibleHeadId = $_GET['flexibleId'];
	$studentId = $_GET['studentId'];

	$con->query("DELETE FROM flexible_to_students WHERE STUDENT_ID = '$studentId' AND FLEXIBLE_HEAD_ID = '$flexibleHeadId';");
	$_SESSION['flexible_head_message'] = "Flexible fee head successfully dissociated!";
	header("Location: ../masters/associate_flexible_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}