<?php
$this->set(compact('inject'));

$this->extend('injects/common');
$this->assign('inject_submit', '');
$this->start('inject_submit');
?>

<div class="row">
	<div class="col-sm-9">
		<p class="form-control-static">This inject must be manually checked by a White Team member.</p>
	</div>
	<div class="col-sm-2">
		<button 
			id="inject<?php echo $inject['Inject']['id']; ?>-requestCheckBtn"
			class="btn btn-primary<?php echo ($this->Inject->completedOrExpired($inject) OR $this->Inject->checkRequested($inject)) ? ' disabled' : ''; ?>" 
			data-toggle="modal" 
			data-target="#manualCheckModal" 
			data-inject-id="<?php echo $inject['Inject']['id']; ?>"
			data-inject-name="<?php echo $inject['Inject']['title']; ?>" 
		>
			<?php echo $this->Inject->checkRequested($inject) ? 'Check Requested' : 'Request Check'; ?>
		</button>
	</div>
</div>

<?php $this->end(); ?>
