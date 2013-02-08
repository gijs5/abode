<?php $this->html->scriptBlock('$(function() { projectsAdd(); });', array('inline'=>false)) ?>
<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb('Add');
$this->Html->addCrumb($client['Client']['name']);
?>
	<?php echo $this->Form->create('Project'); ?>
	
	<p><em>Number of units need to be added. What does this do?</em></p>
	
		<fieldset>
			<legend><?php echo __('Project'); ?></legend>
		<?php
			echo $this->Form->input('Project.countrystate_id', array('type'=>'radio', 'legend'=>'Select a state'));
			echo '<div id="councilSelectBox">Council<br />Select a state first</div>';
			echo $this->Form->input('Project.streettype_id');
			echo $this->Form->input('Project.streetsuffix_id');
			echo $this->Form->input('Project.ownerbuilder');
			echo $this->Form->input('Project.streetnumber');
			echo $this->Form->input('Project.streetname');
			echo $this->Form->input('Project.postalcode');
			echo $this->Form->input('Project.suburb');
			echo $this->Form->input('Project.description');
			echo $this->Form->input('Project.contactname');
			echo $this->Form->input('Project.contactphone');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>