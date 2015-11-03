<h2>Auth Server Administrator Panel</h2>

<ul class="nav nav-pills">
	<li class="<?php echo isset($at_list) ? 'active' : ''; ?>"><?php echo $this->Html->link('User List', '/admin'); ?></li>
	<li class="<?php echo isset($at_create) ? 'active' : ''; ?>"><?php echo $this->Html->link('User Creation', '/admin/create'); ?></li>
	<li class="<?php echo isset($at_groups) ? 'active' : ''; ?>"><?php echo $this->Html->link('Group Management', '/admin/groups'); ?></li>
</ul>

<p>&nbsp;</p>

<table class="table">
	<thead>
		<tr>
			<td>User ID</td>
			<td>Username</td>
			<td>Status</td>
			<td>Groups</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $users AS $user ): ?>
		<tr>
			<td><?php echo $user['User']['id']; ?></td>
			<td><?php echo $user['User']['username']; ?></td>
			<td><?php echo $user['User']['active'] == 1 ? 'Enabled' : 'Disabled'; ?></td>
			<td>
				<?php
					$groups = array();
					foreach ( $user['Group'] AS $group ) {
						$groups[] = $group['human_name'];
					}

					echo implode(', ', $groups);
				?>
			</td>
			<td>
				<?php echo $this->Html->link('Edit', '/admin/edit/'.$user['User']['id']); ?>
				
				<?php if ( $userinfo['id'] != $user['User']['id'] ): ?>

				| <?php echo $this->Html->link('Toggle Status', '/admin/toggleActive/'.$user['User']['id']); ?> 

				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
		<td colspan="5">
			<a href="<?php echo $this->Html->url('/admin/create'); ?>" class="btn btn-primary pull-right">New User</a>
		</td>
	</tr>
	</tbody>
</table>
	
