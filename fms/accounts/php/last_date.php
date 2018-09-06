<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];
    
    $resultClass = $con->query("SELECT CLASS_NAME from classes, classes_in_session WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID = $classId;");
    $row = mysqli_fetch_array($resultClass);
    $className = $row["CLASS_NAME"];

    if (mysqli_num_rows($con->query("SELECT * FROM invoices WHERE CLASS_SESSION_ID = '$classId';")) == 0) { ?>
        <span style="font-family: 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-size: 22px;"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #e15258;"></i> No invoice(s) generated for class <?php echo $className; ?> till now.</span>
    <?php } else {
        $resultDate = $con->query("SELECT * FROM invoices WHERE CLASS_SESSION_ID = '$classId' ORDER BY DATE_ DESC LIMIT 1;");
        $row = $resultDate->fetch_assoc();
        $lastDate = $row['MONTH_TO'] . ', ' . $row['YEAR_TO']; 
    ?>
            <span style="font-family: 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-size: 22px;"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #2c9676;"></i> Invoice(s) already generated for class <?php echo $className; ?> till <?php echo $lastDate; ?>.</span>
        <?php } ?> 

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
