<?php
$groups = array();
foreach ( $groupinfo AS $group ) {
	$groups[] = $group['human_name'];
}
$groups = implode(', ', $groups);
?>
<h2>My Profile</h2>

<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">Username</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?php echo $userinfo['username']; ?>" readonly="readonly" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Groups</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="<?php echo $groups; ?>" readonly="readonly" />
		</div>
	</div>

	<div class="form-group">
		<label for="old_password" class="col-sm-3 control-label">Current Password</label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="old_password" name="old_password" value="" />
		</div>
	</div>

	<div class="form-group">
		<label for="new_password" class="col-sm-3 control-label">New Password</label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="new_password" name="new_password" value="" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-default">Update Profile</button>
		</div>
	</div>
</form>
