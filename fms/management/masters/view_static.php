<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'MANAGEMENT')) {
	require '../../php/db_config.php';
	$navBrand = "View Static Heads";
	$result = $con->query("SELECT * FROM fee_static_heads;");
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | View Static Heads</title>
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

		<!-- container -->
		<div class="container-fluid mt-5">
			<div class="row px-5 mx-5">
				<table class="table table-bordered table-striped mt-3 bg-white table-sm">
					<caption class="lead">List of static heads applied on different classes of the school.</caption>
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Static Fee Head Name</th>
							<th scope="col">Description</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;   //For table indexing. ?>
						<?php while ($row = $result->fetch_assoc()){ ?>
							<tr>
								<th scope="row"><?php echo $i++; ?></th>
								<td><?php echo $row['STATIC_HEAD_NAME']; ?></td>
								<td><?php echo $row['DESCRIPTION']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>	
			<div class="w-sm-100 my-sm-4"></div>

			<footer>
				<?php require '../../templates/footer.php'; ?>
 			</footer>
 		</div><!-- /container -->

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	</body>
</html>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'MANAGEMENT') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the management.";
    }
    header("Location: ../../index.php");
}