<div class="projectsteps form">
<?php echo $this->Form->create('Projectstep'); ?>
	<fieldset>
		<legend><?php echo __('Edit Projectstep'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mandatory');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->element('wysiwyg', array('element'=>'#ProjectstepDescription'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
