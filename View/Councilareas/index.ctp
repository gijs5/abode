<div class="councilareas index">
	<h2><?php echo __('Councilareas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('countrystate_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($councilareas as $councilarea): ?>
	<tr>
		<td><?php echo h($councilarea['Councilarea']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($councilarea['Countrystate']['name'], array('controller' => 'countrystates', 'action' => 'view', $councilarea['Countrystate']['id'])); ?>
		</td>
		<td><?php echo h($councilarea['Councilarea']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $councilarea['Councilarea']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $councilarea['Councilarea']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $councilarea['Councilarea']['id']), null, __('Are you sure you want to delete # %s?', $councilarea['Councilarea']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

