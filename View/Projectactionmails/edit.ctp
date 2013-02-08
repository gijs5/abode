<?php
/*
$this->Html->addCrumb($projectactionmail['Projectaction']['Projectstep']['Stage']['name']);
$this->Html->addCrumb($projectactionmail['Projectaction']['Projectstep']['name']);
$this->Html->addCrumb($projectactionmail['Projectaction']['name']);
$this->Html->addCrumb('Edit default mail');
*/
?>
<div class="projectactionmails form">
<?php echo $this->Form->create('Projectactionmail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Projectactionmail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Contractor', array('label'=>'Recipients'));
		echo $this->Form->input('subject');
		echo $this->Form->input('mail');
		echo $this->element('wysiwyg', array('element'=>'#ProjectactionmailMail', 'style'=>'mail'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>