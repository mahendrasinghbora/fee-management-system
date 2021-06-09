<!-- navbar -->
<nav class="pl-1 pr-0 navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<!-- icon-dashboard -->
	<div class="navbar-brand lead border border-light border-left-0 border-bottom-0 border-top-0 pr-2 mr-0">
		<i class="fa fa-ravelry" aria-hidden="true"></i>
		<span style="font-family: 'Alegreya', Georgia, serif; font-size: 23px;"><?php echo $navBrand; ?></span>
	</div><!-- /icon-dashboard -->

	
	<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<!-- navbar-collapse -->
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link text-light lead pl-1 ml-0 border border-light border-left-0 border-bottom-0 border-top-0" href="<?php echo my_site_path; ?>/index.php" style="font-family: 'Alegreya Sans SC', 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-weight: normal; font-size: 23px;">Home <span class="sr-only">(Fee management system)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light lead pl-1 ml-0" href="<?php echo my_site_path; ?>/<?php echo $_SESSION['userstatus']; ?>/index.php" style="font-family: 'Alegreya Sans SC', 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-weight: normal; font-size: 23px;">Dashboard <span class="sr-only">(<?php echo $_SESSION['userstatus'] . "'s dashboard"; ?>)</span></a>
			</li>
		</ul>
		<div class="btn-group order-1">
		
			<span class="text-light lead">
				<?php if (isset($_SESSION['thumbnail']) && $_SESSION['thumbnail'] != '') { ?>
					<img src="<?php echo $_SESSION['thumbnail']; ?>" class="navbar-item navbar-link mr-1 border border-secondary" style="max-width: 40px; max-height: 40px">
				<?php } ?>
				<?php echo $_SESSION['username']; ?>
			</span>

			<!-- dropdown-useroptions -->
			<a class="nav-item nav-link dropdown-toggle mr-md-2 text-light" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="<?php echo my_site_path; ?>/php/edit_profile.php" style="font-family: 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-size: 23px;">Edit profile</a>
				<a class="dropdown-item" href="<?php echo my_site_path; ?>/php/signout.php" style="font-family: 'Alegreya Sans', Verdana, Tahoma, sans-serif; font-size: 23px;">Sign out</a>
			</div><!-- /dropdown-useroptions -->
		</div>
	</div><!-- navbar-collapse -->
</nav><!-- /navbar -->


