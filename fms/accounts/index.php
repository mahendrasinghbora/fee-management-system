<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid']) && ($_SESSION['userstatus'] == 'ACCOUNTS')) {
	$dashboardNavBrand = "Accounts' Dashboard";
?>

<!doctype html>
<html lang="en">
	<head>
		<title>FMS | Accounts Department's Dashboard</title>
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
			<?php require '../templates/dashboard_navbar.php'; ?>
		</header>
		
		<?php require '../templates/password_msg.php'; ?>
		<?php unset($_SESSION['passwordMessage']); ?>

		<!-- container -->
		<div class="container-fluid mt-5">
			<!-- row1 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
				    	<div class="card text-center card-box">
							<a href="masters/add_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Add Flexible Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Flexible fee heads (applicable on individual students according to the facilities they avail, like bus, canteen, etcetera) can be added student wise in every session (as per the requirement).</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Edit Flexible Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Edit flexible heads. Their name or description can be changed.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #2C9676;">Delete Flexible Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Delete a flexible head.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row1 -->
			
			<div class="w-sm-100 my-sm-4"></div>

			<!-- row2 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
				    	<div class="card text-center card-box">
							<a href="masters/add_static_heads.php">
							<h3 class="card-banner" style="background-color: #5CB860;">Add Static Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Static fee heads (fee heads that are enforced on everyone) can be added class wise whenever needed in every session (as per the requirement).</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_static_heads.php">
							<h3 class="card-banner" style="background-color: #5CB860;">Edit Static Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Edit static heads. Their name or description can be changed.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/add_static_heads.php">
							<h3 class="card-banner" style="background-color: #5CB860;">Delete Static Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Delete a static head.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row2 -->

			<div class="w-sm-100 my-sm-4"></div>

			<!-- row3 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
						<div class="card text-center card-box">
							<a href="masters/associate_static_heads.php">
							<h3 class="card-banner" style="background-color: #C25975;">Associate Static Fee Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Associate static fee heads to classes.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/associate_static_heads.php">
							<h3 class="card-banner" style="background-color: #C25975;">Edit Associated Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Edit static fee heads that have been associated with classes. Amount of static heads associated to classes can be updated.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/associate_static_heads.php">
							<h3 class="card-banner" style="background-color: #C25975;">Delete Associated Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Delete static fee heads that have been associated with classes.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row3 -->

			<div class="w-sm-100 my-sm-4"></div>

			<!-- row4 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
						<div class="card text-center card-box">
							<a href="masters/associate_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #7D669E;">Associate Flexible Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Associate flexible fee heads to students.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/associate_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #7D669E;">Edit Associated Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Edit flexible fee heads that have been associated with students. Amount of flexible heads associated to students can be updated.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/associate_flexible_heads.php">
							<h3 class="card-banner" style="background-color: #7D669E;">Delete Associated Heads</h3>
							<div class="card-body">
								<p class="card-text lead">Delete flexible fee heads that have been associated with students.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row4 -->

			<div class="w-sm-100 my-sm-4"></div>

			<!-- row5 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
						<div class="card text-center card-box">
							<a href="masters/generate_invoices.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Generate Invoice(s)</h3>
							<div class="card-body">
								<p class="card-text lead">Generate invoices for different classes in the session. Invoice(s) must be generated in oreder to pay fee.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/print_invoices.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Print Invoice</h3>
							<div class="card-body">
								<p class="card-text lead">Print the latest generated invoice student-wise.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box">
							<a href="masters/pay_fee.php">
							<h3 class="card-banner" style="background-color: #53BBB4;">Pay Fee</h3>
							<div class="card-body">
								<p class="card-text lead">Pay fee according to the latest invoice student-wise.</p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row5 -->
			
			<div class="w-sm-100 my-sm-4"></div>

			<!-- row6 -->
			<div class="row px-sm-3 mx-md-1">
				<div class="card-deck-wrapper">
					<div class="card-deck">
						<div class="card text-center card-box">
							<a href="masters/reprint_receipts.php">
							<h3 class="card-banner" style="background-color: #C66C5D;">Re-print Receipts</h3>
							<div class="card-body">
								<p class="card-text lead">Re-print receipts using their ID.</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box" style="background-color: #EDEFF0; border-color: #EDEFF0; box-shadow: 0 0 0; color: #EDEFF0;">
							<a href="#">
							<h3 class="card-banner" style="background-color: #EDEFF0;"></h3>
							<div class="card-body">
								<p style="color: #EDEFF0;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro perferendis voluptas magnam voluptatem ex, temporibus blanditiis quasi debitis eaque dolorem!</p>
							</div>
							</a>
						</div>
						<div class="card text-center card-box" style="background-color: #EDEFF0; border-color: #EDEFF0; box-shadow: 0 0 0;">
							<a href="#">
							<h3 class="card-banner" style="background-color: #EDEFF0;"></h3>
							<div class="card-body">
								<p class="card-text lead"></p>
							</div>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /row6 -->
			
			<footer>
				<?php require '../templates/footer.php'; ?>
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
	if ((isset($_SESSION['userid'])) && ($_SESSION['userstatus']) != 'ACCOUNTS') {
		$_SESSION['noAuthority'] = "Hello friend, you don't belong here. Try once you're from the accounts department.";
    }
    header("Location: ../index.php");
}
