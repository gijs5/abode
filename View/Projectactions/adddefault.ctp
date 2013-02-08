<?php
$this->Html->addCrumb($projectstep['Stage']['name']);
$this->Html->addCrumb($projectstep['Projectstep']['name']);
$this->Html->addCrumb('Default Projectactions');
$this->Html->addCrumb('New');
?>
<div class="projectactions form">
<?php echo $this->Form->create('Projectaction'); ?>

	<p><em>By default the contractor is defined by the selected council</em></p>
	<fieldset>
		<legend><?php echo __('Add Projectaction'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('duration', array('type'=>'text'));
		echo $this->Form->input('description');
		echo $this->Form->input('contractortype_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>