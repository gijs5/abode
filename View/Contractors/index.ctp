<div class="contractors index">
	<h2><?php echo __('Contractors'); ?></h2>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('New', array('action'=>'add')) ?>
		<li><?php echo $this->Html->link(__('Contractortypes'), array('controller' => 'contractortypes', 'action' => 'index')); ?> </li>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($contractors as $contractor): ?>
	<tr>
		<td><?php echo h($contractor['Contractor']['id']); ?>&nbsp;</td>
		<td>
			<?php echo h($contractor['Contractor']['name']); ?>
		</td>
		<td><?php echo h($contractor['Contractor']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contractor['Contractor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contractor['Contractor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contractor['Contractor']['id']), null, __('Are you sure you want to delete # %s?', $contractor['Contractor']['id'])); ?>
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