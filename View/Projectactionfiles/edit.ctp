<div class="projectactionfiles form">
<?php echo $this->Form->create('Projectactionfile', array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Projectactionfile'); ?></legend>
	
	<p>Current file: <?php echo $this->Html->link($this->request->data['Projectactionfile']['filename'], '/files/projectaction/'.$this->request->data['Projectactionfile']['filename']) ?></p>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('file', array('type'=>'file', 'label'=>'new file'));
		echo $this->Form->input('comment');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>