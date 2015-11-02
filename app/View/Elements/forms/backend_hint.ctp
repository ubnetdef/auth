<form method="post" class="form-horizontal">
	<input type="hidden" id="<?php echo $prefix; ?>_inject_id" name="inject_id" value="" />
	<input type="hidden" id="<?php echo $prefix; ?>_op" name="op" value="" />
	<input type="hidden" id="<?php echo $prefix; ?>_id" name="id" value="" />

	<div class="form-group">
		<label for="<?php echo $prefix; ?>_order" class="col-sm-2 control-label">Hint Number</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="<?php echo $prefix; ?>_order" name="order" placeholder="" required="required">
		</div>
	</div>

	<div class="form-group">
		<label for="<?php echo $prefix; ?>_description" class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
			<textarea class="form-control wysiwyg" name="description" id="<?php echo $prefix; ?>_description" rows="10"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="active" class="col-sm-2 control-label">Enabled</label>
		<div class="col-sm-8">
			<div class="radio">
				<label>
					<input type="radio" name="active" id="<?php echo $prefix; ?>_activeYes" value="1" required="required">
					Yes
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="active" id="<?php echo $prefix; ?>_activeNo" value="0" required="required">
					No
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="<?php echo $prefix; ?>_time_wait" class="col-sm-2 control-label">Hint Wait Time</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="<?php echo $prefix; ?>_time_wait" name="time_wait" value="0" placeholder="0" required="required" />
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2">
			<p class="help-block">How many seconds after this inject becomes available, should this hint be available?</p>
		</div>
	</div>

	<div class="form-group">
		<label for="<?php echo $prefix; ?>_time_available" class="col-sm-2 control-label">Hint Available Time</label>
		<div class="col-sm-8">
			<div class="input-group date datetimepicker" id="<?php echo $prefix; ?>_time_available_datepicker">
				<input type="text" class="form-control" id="<?php echo $prefix; ?>_time_available" name="time_available" value="0" placeholder="0" required="required" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-2">
			<p class="help-block">What time should this inject become available to everyone?<br /><strong>NOTE</strong>: This is checked <u>AFTER</u> the hint wait time.</p>
		</div>
	</div>
</form>