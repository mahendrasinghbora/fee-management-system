<!-- modal-added -->
<?php
if (isset($_SESSION['static_head_message'])) { ?>
	<div class="modal fade" id="addedModal" tabindex="-1" role="dialog" aria-labelledby="addedModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Success alert!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?php echo $_SESSION['static_head_message']; ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?><!-- /modal-added -->
