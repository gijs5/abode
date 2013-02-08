<?php
$this->Html->addCrumb('Projects');
?>
<div class="projects index">
	<h2><?php echo __('Projects'); ?></h2>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('New', array('action'=>'select_client')) ?>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Countrystate.name'); ?></th>
			<th><?php echo $this->Paginator->sort('displayname'); ?></th>
			<th><?php echo $this->Paginator->sort('contactname'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Countrystate']['name'], array('controller' => 'countrystates', 'action' => 'view', $project['Countrystate']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['displayname']); ?></td>
		<td><?php echo h($project['Project']['contactname']); ?>&nbsp;<?php echo h($project['Project']['contactphone']); ?></td>
		<td><?php echo h($project['Project']['modified']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Stages'), array('controller'=>'projectstages', 'action' => 'index', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
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


