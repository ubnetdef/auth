<?php
$items_in_row = 0;

echo $this->Html->script('backend.team', array('inline' => false));
?>

<h2>Backend Panel - User Manager</h2>
<h4><?php echo $teaminfo['name']; ?> (<?php echo $groupinfo['name']; ?>)</h4>

<?php echo $this->element('navbars/backend_user', array('at_teams' => true)); ?>

<p>&nbsp;</p>

<?php foreach ( $teams AS $team ): ?>

<?php if ( $items_in_row == 0 ): ?>
<div class="row">
<?php endif; ?>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php if ( count($team['User']) == 0 ): ?>
				<form class="form-inline" method="post">
					<input type="hidden" name="op" value="3" />
					<input type="hidden" name="id" value="<?php echo $team['Team']['id']; ?>" />

					<button type="submit" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Are you sure you wish to delete this team?')">DELETE</button>
				</form>
				<?php endif; ?>
				<?php echo $team['Team']['name']; ?>
			</div>

			<ul class="list-group">
				<?php foreach ( $team['User'] AS $user ): ?>
				<li class="list-group-item"><?php echo $user['username']; ?></li>
				<?php endforeach; ?>

				<?php if ( count($team['User']) == 0): ?>
				<li class="list-group-item">There are no users assigned to this team.</li>
				<?php endif; ?>

				<a href="#userAdd" class="list-group-item" data-toggle="modal" data-tid="<?php echo $team['Team']['id']; ?>" data-name="<?php echo $team['Team']['name']; ?>">
					<span class="glyphicon glyphicon-plus"></span> Add user to this team
				</a>
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
				Create a new team
			</div>

			<div class="panel-body">
				<form class="form-horizontal" id="teamCreate-form" method="post">
					<input type="hidden" name="op" value="2" />

					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="team_name" placeholder="Team Name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10">
							<select class="form-control" name="gid">
							<?php foreach ( $groups AS $group ): ?>
								<option value="<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['name']; ?></option>
							<?php endforeach; ?>
							</select>
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

<?php
	echo $this->element('modals/form', array(
		'id'     => 'userAdd',
		'title'  => 'Add User To <span id="userAdd-teamname">...</span>',
		
		'body'   => '<input type="hidden" name="op" value="1" />'.
					'<input type="hidden" name="tid" id="teamAdd-tid" value="" />'.
					'<div class="form-group">'.
					'	<label for="userAdd-select" class="col-sm-2 control-label">Username</label>'.
					'	<div class="col-sm-10">'.
					'		<select class="form-control" name="tid" id="userAdd-select">'.
					'			<option value="-1">Loading...</option>'.
					'		</select>'.
					'	</div>'.
					'</div>',

		'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'.
					'<button type="submit" class="btn btn-primary" id="teamAdd-addBtn">Add Team!</button>',
	));
?>

<script>
$(document).ready(function() {
	InjectEngine_Backend_Team.init('<?php echo $this->Html->url('/backend/user/'); ?>');
});
</script>