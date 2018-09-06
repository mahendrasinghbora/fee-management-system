<?php
$timezone = 'Asia/Kolkata';
$timestamp = getlastmod();
$dt = new DateTime("now", new DateTimeZone($timezone));
$dt->setTimestamp($timestamp);
$lastModified = $dt->format('l, j F Y, h:i:s A');
?>

<!-- footer -->
<div class="row py-3">
	<div class="col-md text-center">
		<hr class="bg-dark">
		<p class="lead">
			&copy; <?php echo date('Y'); ?> Fee Management System<br>
			<?php echo "Last modified: $lastModified"; ?>.<br>
			Developed under the guidance of <a href="http://www.onlinegurujee.in/nitindeepak/" style="font-family: 'Alegreya', Georgia, serif; text-decoration: none;" target="_blank">Dr. Nitin Deepak</a>.<br>
			<i class="fa fa-chevron-left" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i> with <i class="fa fa-heart" aria-hidden="true"></i> using <a href="http://getbootstrap.com/" target="_blank"><img src="<?php echo my_site_path; ?>/img/bootstrap.png" alt="Bootstrap" style="max-width: 30px; max-height: 30px"></a>.<br>
			Special thanks to <a href="https://stackoverflow.com/" target="_blank"><i class="fa fa-stack-overflow" aria-hidden="true"></i></a> and <a href="https://github.com/" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>.
		</p>
	</div>
</div><!-- /footer -->