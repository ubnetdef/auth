<h2>Auth Server Administrator Panel</h2>
<h4><?php echo $teaminfo['name']; ?> (<?php echo $groupinfo['name']; ?>)</h4>

<?php echo $this->element('navbars/backend_user', array('at_create' => true)); ?>

<p>&nbsp;</p>

<?php echo $this->element('forms/backend_user', array('user' => array(), 'teams' => $teams)); ?>