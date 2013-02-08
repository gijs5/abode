<div class="councilareas form">
<?php echo $this->Form->create('Councilarea'); ?>
	<fieldset>
		<legend><?php echo __('Edit Councilarea'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('countrystate_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
