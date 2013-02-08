<div class="councils form">
<?php echo $this->Form->create('Council'); ?>
	<fieldset>
		<legend><?php echo __('Add Council'); ?></legend>
	<?php
		echo $this->Form->input('councilarea_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>