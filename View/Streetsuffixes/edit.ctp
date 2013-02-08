<div class="streetsuffixes form">
<?php echo $this->Form->create('Streetsuffix'); ?>
	<fieldset>
		<legend><?php echo __('Edit Streetsuffix'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('short');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>