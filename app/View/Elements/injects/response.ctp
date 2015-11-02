<?php
$this->set(compact('inject'));

$this->extend('injects/common');
$this->assign('inject_submit', '');
$this->start('inject_submit');
?>

<p><em>Inject Type: Submit</em></p>

<?php $this->end(); ?>
