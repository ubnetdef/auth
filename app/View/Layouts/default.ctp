<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>UBNETDEF Auth Server</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>">
				UBNETDEF Auth Server
			</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="<?php echo isset($at_home) ? 'active' : ''; ?>"><a href="<?php echo $this->Html->url('/'); ?>">Home</a></li>

				<?php if ( !empty($userinfo) ): ?>
				<!-- Links the user has access to -->
				<li><a href="//wiki.ubnetdef.org">Wiki</a></li>
				<?php endif; ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<?php if ( !empty($userinfo) ): ?>

				<?php if ( $is_admin ): ?>
				<li class="<?php echo isset($at_admin) ? 'active' : ''; ?>"><a href="<?php echo $this->Html->url('/admin'); ?>">Admin Panel</a></li>
				<?php endif; ?>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
						<?php echo $userinfo['username']; ?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class=""><a href="<?php echo $this->Html->url('/user/profile'); ?>">My Profile</a></li>
						<li class=""><a href="<?php echo $this->Html->url('/logout/'.$userinfo['logout_token']); ?>">Logout</a></li>
					</ul>
				</li>

				<?php else: ?>
				<li class="<?php echo isset($at_login) ? 'active' : ''; ?>"><a href="<?php echo $this->Html->url('/login'); ?>">Login</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<?php echo $this->Session->flash(); ?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="text-muted pull-right">
			AuthServer <abbr title="<?php echo $version_long; ?>"><?php echo $version; ?></abbr> // Created by <a href="//james.droste.im">James Droste</a>
		</p>
	</div>
</footer>

</body>
</html>
