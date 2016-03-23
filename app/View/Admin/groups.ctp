<?php
$items_in_row = 0;

echo $this->Html->script('admin.group', array('inline' => false));
?>

<h2>Auth Server Administrator Panel</h2>

<?php echo $this->element('navbars/admin', array('at_groups' => true)); ?>

<p>&nbsp;</p>

<?php foreach ( $groups AS $group ): ?>

<?php if ( $items_in_row == 0 ): ?>
<div class="row">
<?php endif; ?>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php if ( count($group['User']) == 0 ): ?>
				<form class="form-inline" method="post">
					<input type="hidden" name="op" value="3" />
					<input type="hidden" name="gid" value="<?php echo $group['Group']['id']; ?>" />

					<button type="submit" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Are you sure you wish to delete this group?')">DELETE</button>
				</form>
				<?php endif; ?>
				<?php echo $group['Group']['human_name'].' ('.$group['Group']['machine_name'].')'; ?>
			</div>

			<ul class="list-group">
				<?php foreach ( $group['User'] AS $user ): ?>
				<li class="list-group-item"><?php echo $user['username']; ?></li>
				<?php endforeach; ?>

				<?php if ( count($group['User']) == 0): ?>
				<li class="list-group-item">There are no users assigned to this group.</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

<?php if ( $items_in_row == 1 ): $items_in_row = -1;?>
</div>
<?php endif; ?>

<?php $items_in_row++; ?>
<?php endforeach; ?>

<?php if ( $items_in_row == 0 ): ?>
<div class="row">
<?php endif; ?>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Create a new group
			</div>

			<div class="panel-body">
				<form class="form-horizontal" id="groupCreate-form" method="post">
					<input type="hidden" name="op" value="2" />

					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="human_name" placeholder="Group Human Name">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="machine_name" placeholder="Group Machine Name">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Create!</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php if ( $items_in_row != 0 ): ?>
</div>
<?php endif; ?>
