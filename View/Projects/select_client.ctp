<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb('Add');
$this->Html->addCrumb('Select Client');
?>
<div class="select_client index">
	<h2><?php echo __('Client'); ?></h2>
	<p><em>Select or create a client.</em></p>
	
	<div class="coll-left">
		<?php echo $this->Form->create('Client'); ?>
		<fieldset>
			<legend><?php echo __('Add Client'); ?></legend>
		<?php
			echo $this->Form->input('Type.type', array('value'=>'new', 'type'=>'hidden'));
			echo $this->Form->input('name');
			echo $this->Form->input('User.username');
			echo $this->Form->input('User.password');
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Next')); ?>
	</div>
	
	<div class="coll-right">
		<?php echo $this->Form->create('Client'); ?>
		<fieldset>
			<legend><?php echo __('Existing Client'); ?></legend>
		<?php
			echo $this->Form->input('Type.type', array('value'=>'existing', 'type'=>'hidden'));
			echo $this->Form->input('client_id');
		?>
		</fieldset>
		<?php echo $this->Form->end(__('Next')); ?>
	</div>
	
</div>