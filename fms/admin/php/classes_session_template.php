<?php session_start();
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';
	$sessionId = $_POST['sessionId'];
	$result = $con->query("SELECT * FROM classes_in_session, classes WHERE SESSION_ID = '$sessionId' AND classes.CLASS_ID = classes_in_session.CLASS_ID;");
?>

<table class="table table-striped mt-3 bg-white table-bordered table-sm">
	<caption class="lead">List of already added classes to the session.</caption>
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Class Name</th>
			<th scope="col">Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1;   //For table indexing. ?>
		<?php while ($row = $result->fetch_assoc()){ ?>
			<tr>
				<th scope="row"><?php echo $i++; ?></th>
				<td><?php echo $row['CLASS_NAME']; ?></td>
				<td><a href="../php/delete_classes_session.php?classId=<?php echo $row['CLASS_ID']; ?>&sessionId=<?php echo $sessionId; ?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../index.php");
}

