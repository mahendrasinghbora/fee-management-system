<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {

    require '../../php/db_config.php';
    $userId = $_SESSION['userid'];
    $classId = $_POST["classId"];
    $flexibleHeadId = $_POST["flexibleHeadId"];
    $flexibleHeadAmount = $_POST["flexibleHeadAmount"];
    $studentId = $_POST["studentId"];
    if (mysqli_num_rows($con->query("SELECT * FROM flexible_to_students WHERE FLEXIBLE_HEAD_ID='$flexibleHeadId' AND STUDENT_ID='$studentId';")) != 0) {
        $_SESSION['flexible_error_message'] = "Flexible fee head already associated!";
    }
    else {
        $result = $con->query("INSERT INTO flexible_to_students (CLASS_SESSION_ID, STUDENT_ID, FLEXIBLE_HEAD_ID, FLEXIBLE_HEAD_AMOUNT, USER_ID, STATUS) VALUES('$classId', '$studentId', '$flexibleHeadId', '$flexibleHeadAmount', '$userId', 1);");
        $_SESSION['flexible_head_message'] = "Flexible fee head successfully associated!";
    }
    header("Location: ../masters/associate_flexible_heads.php");
?>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}

