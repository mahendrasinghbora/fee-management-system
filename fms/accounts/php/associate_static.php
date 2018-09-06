<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {

    require '../../php/db_config.php';
    $userId = $_SESSION['userid'];
    $classId = $_POST["classId"];
    $staticHeadId = $_POST["staticHeadId"];
    $staticHeadAmount = $_POST["staticHeadAmount"];
    if (mysqli_num_rows($con->query("SELECT * FROM static_to_classes WHERE STATIC_HEAD_ID='$staticHeadId' AND CLASS_SESSION_ID='$classId';")) != 0) {
        $_SESSION['static_error_message'] = "Static fee head already associated!";
    }
    else {
        $result = $con->query("INSERT INTO static_to_classes (CLASS_SESSION_ID, STATIC_HEAD_ID, STATIC_HEAD_AMOUNT, USER_ID, STATUS) VALUES('$classId', '$staticHeadId', '$staticHeadAmount', '$userId', 1);");
        $_SESSION['static_head_message'] = "Static fee head successfully associated!";
    }
    header("Location: ../masters/associate_static_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}

