<div class="councilareas view">
<h2><?php  echo __('Councilarea'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($councilarea['Councilarea']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Countrystate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($councilarea['Countrystate']['name'], array('controller' => 'countrystates', 'action' => 'view', $councilarea['Countrystate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($councilarea['Councilarea']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>