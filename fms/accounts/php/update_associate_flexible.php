<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$flexibleHeadId = $_POST['flexibleHeadId'];
	$studentId = $_POST['studentId'];
	$flexibleAmount = $_POST['flexibleHeadAmount'];

	$con->query("UPDATE flexible_to_students SET FLEXIBLE_HEAD_AMOUNT = '$flexibleAmount' WHERE FLEXIBLE_HEAD_ID = '$flexibleHeadId' AND STUDENT_ID = '$studentId';");

	$_SESSION['flexible_head_message'] = "Associated flexible fee head successfully updated!";
	header("Location: ../masters/associate_flexible_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}