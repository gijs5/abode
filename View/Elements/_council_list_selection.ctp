<?php $this->html->scriptBlock('$(function() { tabs("#tabs"); showCheckboxAmountInTab("#tabs"); });', array('inline'=>false)) ?>

<div id="tabs" class="councils-list">
	<ul>
		<?php $i=1; foreach ($councils as $countrystate => $councilareas): ?>
		<li><a href="#tabs-<?php echo $i ?>"><?php echo $countrystate ?> <span class="amount">(...)</span></a></li>
		<?php $i++; endforeach; ?>
	</ul>
	<?php $i=1; foreach ($councils as $countrystate => $councilareas): ?>
	<div id="tabs-<?php echo $i ?>">
		<?php echo $this->Form->input('Council.'.$countrystate, array('multiple'=>'checkbox', 'options'=>$councilareas, 'selected'=>@$selected_councils)); ?>
	</div>
	<?php $i++; endforeach; ?>
</div>
</fieldset>