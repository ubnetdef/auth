<h2>Error</h2>

<div class="alert alert-danger">
	You are missing/have an invalid logout token. <a href="<?php echo $this->Html->url('/user/logout/'.$userinfo['logout_token']); ?>">Logout</a>.
</div>
