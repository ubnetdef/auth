<h2>Please Login</h2>

<div class="alert alert-danger">
	<p><strong>PLEASE NOTE</strong>: Access to this website is restricted. All actions are logged.</p>
</div>

<form method="post" class="form-horizontal">
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" tabindex="1" required="required" autofocus="autofocus" />
		</div>
	</div>

	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="password" name="password" tabindex="2" required="required" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default" >Login</button>
		</div>
	</div>
</form>
