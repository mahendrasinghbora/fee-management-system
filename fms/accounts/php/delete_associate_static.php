<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	require '../../php/db_config.php';

	$staticHeadId = $_GET['staticId'];
	$classId = $_GET['classId'];

	$con->query("DELETE FROM static_to_classes WHERE CLASS_SESSION_ID = '$classId' AND STATIC_HEAD_ID = '$staticHeadId';");
	$_SESSION['static_head_message'] = "Static fee head successfully dissociated!";
	header("Location: ../masters/associate_static_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}