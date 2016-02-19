<h2>Auth Server Administrator Panel</h2>

<?php echo $this->element('navbars/admin', array('at_list' => true)); ?>

<p>&nbsp;</p>

<table class="table">
	<thead>
		<tr>
			<td width="10%">User ID</td>
			<td width="20%">Username</td>
			<td width="40%">Groups</td>
			<td width="10%">Status</td>
			<td width="20%">Actions</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $users AS $user ): ?>
		<tr>
			<td><?php echo $user['User']['id']; ?></td>
			<td><?php echo $user['User']['username']; ?></td>
			<td>
				<?php
					$groups = array();
					foreach ( $user['Group'] AS $group ) {
						$groups[] = $group['human_name'];
					}

					echo implode(', ', $groups);
				?>
			</td>
			<td><?php echo $user['User']['active'] == 1 ? 'Enabled' : 'Disabled'; ?></td>
			<td>
				<?php echo $this->Html->link('Edit', '/admin/edit/'.$user['User']['id'], array('class' => 'btn btn-primary btn-xs')); ?>
				
				<?php if ( $userinfo['id'] != $user['User']['id'] ): ?>

				<br /><?php echo $this->Html->link('Toggle Status', '/admin/toggleActive/'.$user['User']['id'], array('class' => 'btn btn-primary btn-xs')); ?> 

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
	
