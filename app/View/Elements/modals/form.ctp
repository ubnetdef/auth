<div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form <?php echo isset($action) ? 'action="'.$action.'" ' : ''; ?>method="post" id="<?php echo $id; ?>-form" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><?php echo $title; ?></h4>
				</div>

				<div class="modal-body">
					<?php echo $body; ?>
				</div>

				<?php if ( isset($footer) ): ?>
				<div class="modal-footer">
					<?php echo $footer; ?>
				</div>
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>