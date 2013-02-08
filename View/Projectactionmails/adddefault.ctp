<?php
$this->Html->addCrumb($projectaction['Projectstep']['Stage']['name']);
$this->Html->addCrumb($projectaction['Projectstep']['name']);
$this->Html->addCrumb($projectaction['Projectaction']['name']);
$this->Html->addCrumb('Add default mail');
?>
<div class="projectactionmails form">
<?php echo $this->Form->create('Projectactionmail'); ?>
	<fieldset>
		<legend><?php echo __('Add Projectactionmail'); ?></legend>
	<?php
		echo $this->Form->input('Contractortype', array('label'=>'Recipients'));
		echo $this->Form->input('mail');
		echo $this->element('wysiwyg', array('element'=>'#ProjectactionmailMail', 'style'=>'mail'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>