<?php echo $this->Html->css('bootstrap-datetimepicker.min', array('inline' => false)); ?>

<?php echo $this->Html->script('moment.min', array('inline' => false)); ?>
<?php echo $this->Html->script('bootstrap-datetimepicker.min', array('inline' => false)); ?>

<form method="post" class="form-horizontal">
	<div class="form-group">
		<label for="username" class="col-sm-3 control-label">Username</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="username" name="username" value="<?php echo !empty($user) ? $user['User']['username'] : ''; ?>" required="required" />
		</div>
	</div>

	<div class="form-group">
		<label for="password" class="col-sm-3 control-label">Password</label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="password" name="password" value="" />
		</div>
	</div>

	<div class="form-group">
		<label for="team_id" class="col-sm-3 control-label">Team Membership</label>
		<div class="col-sm-9">
			<select class="form-control" id="team_id" name="team_id" required="required">
				<?php foreach($teams AS $team): ?>
				<option value="<?php echo $team['Team']['id']; ?>"<?php echo (!empty($user) && !empty($team) && $user['User']['team_id'] == $team['Team']['id']) ? ' selected="selected"' : ''; ?>>
					<?php echo $team['Team']['name']; ?>
				</option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="expires" class="col-sm-3 control-label">Account Expiration</label>
		<div class="col-sm-9">
			<div class="input-group date datetimepicker" id="expires_datepicker">
				<input type="text" class="form-control time-use-data" id="expires" name="expires" value="<?php echo !empty($user) ? $user['User']['expires'] : ''; ?>"  required="required" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3">
			<p class="help-block">Please enter "0" if this account will never expire</p>
		</div>
	</div>

	<div class="form-group">
		<label for="active" class="col-sm-3 control-label">Enabled</label>
		<div class="col-sm-9">
			<div class="radio">
				<label>
					<input type="radio" name="active" id="activeYes" value="1"<?php echo (!empty($user) && $user['User']['active'] == 1) ? ' checked="checked"' : ''; ?> required="required">
					Yes
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="active" id="activeNo" value="0"<?php echo (!empty($user) && $user['User']['active'] == 0) ? ' checked="checked"' : ''; ?> required="required">
					No
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-default"><?php echo !empty($user) ? 'Edit' : 'Create'; ?> User</button>
		</div>
	</div>
</form>

<script>
$(document).ready(function() {
	$('.datetimepicker').datetimepicker({
		sideBySide: true,
		keepInvalid: true,
	});

	<?php if ( !empty($user) && $user['User']['expires'] > 0 ): ?>
	$('#expires_datepicker').data('DateTimePicker').date(moment.unix('<?php echo $user['User']['expires']; ?>'));
	<?php endif; ?>

	$('form').submit(function() {
		$('.datetimepicker').each(function() {
			dtp = $(this).data('DateTimePicker');
			input = $(this).children('input');

			if ( !$.isNumeric(input.val()) ) {
				// Not a number. Let's get the date from DTP
				input.val(dtp.date().utc().unix());
			}
		});
	});
});
</script>