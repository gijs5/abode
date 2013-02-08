<div class="councils form">
<?php echo $this->Form->create('Council'); ?>
	<fieldset>
		<legend><?php echo __('Edit Council'); ?></legend>
	<?php
		echo $this->Form->input('Council.id');
		echo $this->Form->input('Council.councilarea_id');
		echo $this->Form->input('Council.name');
		$i=0;
		foreach ($contractortypes as $id => $name) {
			echo $this->Form->input('ContractorsCouncil.'.$i.'.council_id', array('value'=>$this->request->data['Council']['id'], 'type'=>'hidden'));
			echo $this->Form->input('ContractorsCouncil.'.$i.'.contractortype_id', array('value'=>$id, 'type'=>'hidden'));
			echo $this->Form->input('ContractorsCouncil.'.$i.'.contractor_id', array('label'=>$name, 'options'=>(isset($contractors[$id]) ? $contractors[$id]: array()), 'empty'=>'-select-'));
			$i++;
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>