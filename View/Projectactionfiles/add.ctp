<div class="projectactionfiles form">
<?php echo $this->Form->create('Projectactionfile', array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Projectactionfile'); ?></legend>
	
	<?php
		echo $this->Form->input('file', array('type'=>'file'));
		echo $this->Form->input('comment');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>