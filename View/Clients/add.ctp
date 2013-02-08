<div class="clients form">
<?php echo $this->Form->create('Client'); ?>
	<fieldset>
		<legend><?php echo __('Client'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
	<fieldset>
		<legend><?php echo __('Login details'); ?></legend>
	<?php
		echo $this->Form->input('User.username');
		echo $this->Form->input('User.password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>