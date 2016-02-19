<?php
if ( !empty($user) ) {
	$gps = array();

	foreach ( $user['Group'] AS $ugrp ) {
		$grps[] = $ugrp['id'];
	}

	$user['Groups_flat'] = $grps;
}
?>
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
		<label for="team_id" class="col-sm-3 control-label">Groups</label>
		<div class="col-sm-9">
			<select class="form-control" id="team_id" name="team_id" required="required" multiple="multiple">
				<?php foreach($groups AS $group): ?>
				<option value="<?php echo $group['Group']['id']; ?>"<?php echo (!empty($user) && in_array($group['Group']['id'], $user['Groups_flat'])) ? ' selected="selected"' : ''; ?>>
					<?php echo $group['Group']['human_name']; ?>
				</option>
				<?php endforeach; ?>
			</select>
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
