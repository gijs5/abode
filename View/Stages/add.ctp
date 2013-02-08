<div class="stages form">
<?php echo $this->Form->create('Stage'); ?>
	<fieldset>
		<legend><?php echo __('Add Stage'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
