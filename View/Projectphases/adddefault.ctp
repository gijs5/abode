<div class="projectphases form">
<?php echo $this->Form->create('Projectphase'); ?>
	<fieldset>
		<legend><?php echo __('Add Projectphase'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>