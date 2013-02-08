<div class="councils index">
	<h2><?php echo __('Councils'); ?></h2>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('New', array('action'=>'add')) ?>
		<li><?php echo $this->Html->link(__('Councilareas'), array('controller' => 'councilareas', 'action' => 'index')); ?> </li>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('councilarea_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($councils as $council): ?>
	<tr>
		<td><?php echo h($council['Council']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($council['Councilarea']['name'], array('controller' => 'councilareas', 'action' => 'view', $council['Councilarea']['id'])); ?>
		</td>
		<td><?php echo h($council['Council']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $council['Council']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $council['Council']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $council['Council']['id']), null, __('Are you sure you want to delete # %s?', $council['Council']['id'])); ?>
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
