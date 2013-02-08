<div class="contractortypes form">
<?php echo $this->Form->create('Contractortype'); ?>
	<fieldset>
		<legend><?php echo __('Add Contractortype'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>