<div class="contractors form">
<?php echo $this->Form->create('Contractor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contractor'); ?></legend>
	
	<?php
		echo $this->Form->input('Contractor.id');
		echo $this->Form->input('Contractor.contractortype_id');
		echo $this->Form->input('Contractor.name');
		echo $this->Form->input('Contractor.email');
		echo $this->Form->input('Contractor.phone');
		echo $this->Form->input('Contractor.address');

		echo $this->Form->input('User.id');
		echo $this->Form->input('User.username');
		echo $this->Form->input('User.password');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>