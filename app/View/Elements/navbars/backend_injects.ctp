<ul class="nav nav-pills">
	<li class="<?php echo isset($at_list) ? 'active' : ''; ?>"><?php echo $this->Html->link('Inject List', '/backend/injects'); ?></li>
	<li class="<?php echo isset($at_create) ? 'active' : ''; ?>"><?php echo $this->Html->link('Create Inject', '/backend/injects/create'); ?></li>
	<!--
	<li class="<?php echo isset($at_schedule) ? 'active' : ''; ?>"><?php echo $this->Html->link('Inject Schedule', '/backend/injects/schedule'); ?></li>
	-->
	<li class="<?php echo isset($at_hints) ? 'active' : ''; ?>"><?php echo $this->Html->link('Inject Hints', '/backend/injects/hints'); ?></li>
	<li class="<?php echo isset($at_responses) ? 'active' : ''; ?>"><?php echo $this->Html->link('Inject Responses', '/backend/injects/responses'); ?></li>
</ul>