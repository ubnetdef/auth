<h2>Logout</h2>

<div class="alert alert-info">
	To logout, please press the logout button below.
</div>

<a href="<?php echo $this->Html->url('/user/logout/'.$userinfo['logout_token']); ?>" class="btn btn-primary btn-lg center-block">Logout</a>