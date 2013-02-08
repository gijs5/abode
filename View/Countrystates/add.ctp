<div class="countrystates form">
<?php echo $this->Form->create('Countrystate'); ?>
	<fieldset>
		<legend><?php echo __('Add Countrystate'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
