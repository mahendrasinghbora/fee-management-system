<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $studentId = $_POST['studentId'];

    $result = $con->query("SELECT fee_flexible_heads.FLEXIBLE_HEAD_ID, FLEXIBLE_HEAD_NAME, FLEXIBLE_HEAD_AMOUNT FROM fee_flexible_heads, flexible_to_students WHERE STUDENT_ID = '$studentId' AND fee_flexible_heads.FLEXIBLE_HEAD_ID = flexible_to_students.FLEXIBLE_HEAD_ID;");

    $resultStudent = $con->query("SELECT STUDENT_NAME FROM students WHERE STUDENT_ID = '$studentId';");
    $studentName = $resultStudent->fetch_assoc();
?>

<table class="table table-bordered table-striped mt-3 bg-white table-sm">
    <caption class="lead">List of already associated flexible fee heads to student <?php echo $studentName['STUDENT_NAME']; ?>.</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Flexible Fee Head Name</th>
            <th scope="col">Amount (in &#8377;)</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;   //For table indexing. ?>
        <?php while ($row = $result->fetch_assoc()){ ?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $row['FLEXIBLE_HEAD_NAME']; ?></td>
                <td><?php echo $row['FLEXIBLE_HEAD_AMOUNT']; ?></td>
                <td><a href="../php/edit_associate_flexible.php?flexibleId=<?php echo $row['FLEXIBLE_HEAD_ID']; ?>&studentId=<?php echo $studentId; ?>&flexibleAmount=<?php echo $row['FLEXIBLE_HEAD_AMOUNT']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="../php/delete_associate_flexible.php?flexibleId=<?php echo $row['FLEXIBLE_HEAD_ID']; ?>&studentId=<?php echo $studentId; ?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php } else {
    $_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
        $_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../../index.php");
}
