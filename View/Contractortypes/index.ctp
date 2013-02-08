<div class="contractortypes index">
	<h2><?php echo __('Contractortypes'); ?></h2>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('New', array('action'=>'add')) ?>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($contractortypes as $contractortype): ?>
	<tr>
		<td><?php echo h($contractortype['Contractortype']['id']); ?>&nbsp;</td>
		<td><?php echo h($contractortype['Contractortype']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contractortype['Contractortype']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contractortype['Contractortype']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contractortype['Contractortype']['id']), null, __('Are you sure you want to delete # %s?', $contractortype['Contractortype']['id'])); ?>
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