<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb($projectstep['Projectstage']['Project']['displayname']);
$this->Html->addCrumb($projectstep['Projectstage']['Stage']['name']);
$this->Html->addCrumb($projectstep['Projectstep']['name']);
$this->Html->addCrumb('Add Action');
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
		echo $this->Form->input('contractortype_id', array('title'=>'By default the contractor is defined by the selected council in the project'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>