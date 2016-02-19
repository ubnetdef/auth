<h2>Auth Server Administrator Panel</h2>
<h4>Modifying User</h4>

<?php echo $this->element('navbars/admin', array('at_list' => true)); ?>

<p>&nbsp;</p>

<?php echo $this->element('forms/user', array('user' => $user, 'groups' => $groups)); ?>