<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
    require '../../php/db_config.php';
    $classId = $_POST['classId'];

    $result = $con->query("SELECT fee_static_heads.STATIC_HEAD_ID, STATIC_HEAD_NAME, STATIC_HEAD_AMOUNT FROM fee_static_heads, static_to_classes WHERE CLASS_SESSION_ID = $classId AND fee_static_heads.STATIC_HEAD_ID = static_to_classes.STATIC_HEAD_ID;");

    $resultClass = $con->query("SELECT CLASS_NAME, CLASS_SESSION_ID FROM classes_in_session, classes WHERE classes.CLASS_ID = classes_in_session.CLASS_ID AND CLASS_SESSION_ID=" . $classId . ";");
    $className = $resultClass->fetch_assoc();
?>

<table class="table table-striped mt-3 bg-white table-bordered table-sm">
    <caption class="lead">List of already associated static fee heads to class <?php echo $className['CLASS_NAME']; ?>.</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Static Fee Head Name</th>
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
                <td><?php echo $row['STATIC_HEAD_NAME']; ?></td>
                <td><?php echo $row['STATIC_HEAD_AMOUNT']; ?></td>
                <td><a href="../php/edit_associate_static.php?staticId=<?php echo $row['STATIC_HEAD_ID']; ?>&classId=<?php echo $classId; ?>&staticAmount=<?php echo $row['STATIC_HEAD_AMOUNT']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="../php/delete_associate_static.php?staticId=<?php echo $row['STATIC_HEAD_ID']; ?>&classId=<?php echo $classId; ?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
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
