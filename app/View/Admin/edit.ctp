<h2>Auth Server Administrator Panel</h2>
<h4>Modifying User</h4>

<?php echo $this->element('navbars/backend_user', array('at_list' => true)); ?>

<p>&nbsp;</p>

<?php echo $this->element('forms/backend_user', array('user' => $user, 'teams' => $teams)); ?>