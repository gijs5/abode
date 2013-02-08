<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb($this->request->data['Projectstep']['Projectstage']['Project']['displayname']);
$this->Html->addCrumb($this->request->data['Projectstep']['Projectstage']['Stage']['name']);
$this->Html->addCrumb($this->request->data['Projectstep']['name']);
$this->Html->addCrumb('Edit '.$this->request->data['Projectaction']['name']);
?>
<div class="projectactions form">
<?php echo $this->Form->create('Projectaction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Projectaction'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('duration', array('type'=>'text'));
		echo $this->Form->input('description');
		echo $this->Form->input('contractor_id', array('empty'=>'Select a contractor', 'title'=>'By default the contractor is defined by the selected council in the project'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>