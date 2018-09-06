<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$staticHeadId = $_POST['staticHeadId'];
	$classId = $_POST['classId'];
	$staticAmount = $_POST['staticHeadAmount'];

	$con->query("UPDATE static_to_classes SET STATIC_HEAD_AMOUNT = '$staticAmount' WHERE STATIC_HEAD_ID = '$staticHeadId' AND CLASS_SESSION_ID = '$classId';");

	$_SESSION['static_head_message'] = "Associated static fee head successfully updated!";
	header("Location: ../masters/associate_static_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}