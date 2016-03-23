<ul class="nav nav-pills">
	<li class="<?php echo isset($at_list) ? 'active' : ''; ?>"><?php echo $this->Html->link('User List', '/admin'); ?></li>
	<li class="<?php echo isset($at_create) ? 'active' : ''; ?>"><?php echo $this->Html->link('User Creation', '/admin/create'); ?></li>
	<li class="<?php echo isset($at_groups) ? 'active' : ''; ?>"><?php echo $this->Html->link('Group Management', '/admin/groups'); ?></li>
	<li class="<?php echo isset($at_logs) ? 'active' : ''; ?>"><?php echo $this->Html->link('Logs', '/admin/logs'); ?></li>
</ul>