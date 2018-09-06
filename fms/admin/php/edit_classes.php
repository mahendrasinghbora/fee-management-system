<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ADMIN')) {
	require '../../php/db_config.php';
	$result = $con->query("SELECT * FROM classes;");
	$resultEdit = $con->query("SELECT * FROM classes WHERE CLASS_ID ='" . $_GET['classId'] . "';");
	$rowEdit = $resultEdit->fetch_assoc();
	$navBrand = 'EDIT CLASSES';
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Edit Classes</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<!-- shortcut-icon -->
		<link rel="shortcut icon" href="<?php echo my_site_path; ?>/img/favicon.png"><!-- /shortcut-icon -->
		<!-- custom-stylesheet -->
		<link rel="stylesheet" href="<?php echo my_site_path; ?>/css/main.css" type="text/css"><!-- /custom-stylesheet -->
		<!-- font-awesome-icons -->
		<link rel="stylesheet" href="<?php echo my_site_path; ?>/css/font-awesome/css/font-awesome.min.css"><!-- /font-awesome-icons -->
	</head>

	<body>
		<header>
			<?php require '../../templates/navbar.php'; ?>
		</header>

		<?php require '../../templates/admin_message.php'; ?>
		<?php unset($_SESSION['admin_message']); ?>
		
		<!-- container -->
		<div class="container-fluid px-5">
			<div class="row pt-5">
				<!-- form -->
				<div class="col-lg-4 ml-sm-auto mt-4">
					<h3 class="form-banner" style="background-color: #53BBB4;">Edit Classes</h3>
					<form class="form px-3 py-3" action="../php/update_classes.php" method="post">
						<div class="form-group">
							<label for="className">Class Name</label>
							<input type="text" class="form-control" id="className" name="className" aria-describedby="classHelp" placeholder="Enter class name" value="<?php echo $rowEdit['CLASS_NAME']; ?>">
							<small id="classHelp" class="form-text text-muted sr-only">Add a class to the school.</small>
						</div>
						<input type="hidden" name="classId" value="<?php echo $_GET['classId']; ?>">
						<button type="submit" class="btn btn-success btn-block">Update</button>
						<button type="reset" class="btn btn-info btn-block">Reset</button>
					</form>
				</div>
				<!-- /form -->

				<div class="col-lg-8 d-none d-sm-block ml-sm-auto mt-2">
					<table class="table table-bordered table-striped mt-3 bg-white table-sm">
						<caption class="lead">List of already added classes.</caption>
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Class Name</th>
								<th scope="col">Edit</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;   //For table indexing. ?>
							<?php while ($row = $result->fetch_assoc()){ ?>
								<?php if ($row['CLASS_ID'] == $_GET['classId']) { ?>
									<tr class="table-info">
								<?php } else {?>
									<tr>
									<?php } ?>
									<th scope="row"><?php echo $i++; ?></th>
									<td><?php echo $row['CLASS_NAME']; ?></td>
									<td><a href="../php/edit_classes.php?classId=<?php echo $row['CLASS_ID'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
									<td><a href="../php/delete_classes.php?classId=<?php echo $row['CLASS_ID'];?>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="w-100 my-5"></div>

			
			<footer>
				<?php require '../../templates/footer.php'; ?>
			</footer>
 		</div><!-- /container -->

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script>        
			$(document).ready(function () {
				$('#addedModal').modal('show');
			});
		</script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ADMIN') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're an admin.";
    }
    header("Location: ../../index.php");
}

