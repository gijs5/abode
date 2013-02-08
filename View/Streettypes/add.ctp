<div class="streettypes form">
<?php echo $this->Form->create('Streettype'); ?>
	<fieldset>
		<legend><?php echo __('Add Streettype'); ?></legend>
	<?php
		echo $this->Form->input('short');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>