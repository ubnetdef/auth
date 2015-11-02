<ul class="nav nav-pills">
	<li class="<?php echo isset($at_events) ? 'active' : ''; ?>"><?php echo $this->Html->link('Team Events', '/team'); ?></li>
	<li class="<?php echo isset($at_membership) ? 'active' : ''; ?>"><?php echo $this->Html->link('Team Membership', '/team/membership'); ?></li>
	<!--
	<li class="<?php echo isset($at_account_info) ? 'active' : ''; ?>"><?php echo $this->Html->link('Account Info Change', '/team/accounts'); ?></li>
	<li class="<?php echo isset($at_service_config) ? 'active' : ''; ?>"><?php echo $this->Html->link('Service Configuration', '/team/service'); ?></li>
	-->
</ul>