<?php
$this->set(compact('inject'));

$this->extend('injects/common');
$this->assign('inject_submit', '');
$this->start('inject_submit');
?>

<form action="#" class="form-horizontal">
	<div class="form-group">
		<label for="inject<?php echo $inject['Inject']['id']; ?>-flag" class="col-sm-1 control-label">Flag</label>
		<div class="col-sm-9">
			<input 
				type="<?php echo ($this->Inject->completedOrExpired($inject)) ? 'password' : 'text'; ?>" 
				class="form-control inject-flag" 
				id="inject<?php echo $inject['Inject']['id']; ?>-flag" 
				placeholder="Enter Key Here"
				data-inject-id="<?php echo $inject['Inject']['id']; ?>" 
				<?php echo ($this->Inject->completedOrExpired($inject)) ? 'disabled="disabled" value="good_try_but_no_password_here"' : ''; ?>
			>
		</div>
		<div class="col-sm-2">
			<button type="submit" class="btn btn-primary"<?php echo ($this->Inject->completedOrExpired($inject)) ? ' disabled="disabled"' : ''; ?>>
				Submit
			</button>
		</div>
	</div>
</form>
<div class="alert alert-danger text-center hidden" id="inject<?php echo $inject['Inject']['id']; ?>-invalid">
	<strong>Invalid Password!</strong> No guessing!
</div>

<?php $this->end(); ?>
