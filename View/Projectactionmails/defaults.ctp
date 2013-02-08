<?php
$this->Html->addCrumb($projectaction['Projectstep']['Stage']['name']);
$this->Html->addCrumb($projectaction['Projectstep']['name']);
$this->Html->addCrumb($projectaction['Projectaction']['name']);
$this->Html->addCrumb('Default Mails');
?>
<div class="projectactionmails index">
	<h2><?php echo __('Projectactionmails'); ?></h2>
	
	<ul>
		<li><?php echo $this->Html->link('New', array('action'=>'adddefault', $projectaction['Projectaction']['id'])) ?>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Recipients</th>
			<th>Created</th>
			<th>Modified</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($projectaction['Projectactionmail'] as $projectactionmail): ?>
	<tr>
		<td>
			<?php if (!empty($projectactionmail['Contractortype'])): ?>
				<?php $contractortypes=array(); foreach ($projectactionmail['Contractortype'] as $contractortype): ?>
					<?php $contractortypes[] = $this->Html->link($contractortype['name'], array('controller' => 'contractortypes', 'action' => 'view', $contractortype['id'])); ?>
				<?php endforeach ?>
				<?php echo implode(', ', $contractortypes); ?>
			<?php else: ?>
				<em>No recipients found</em>
			<?php endif ?>
		</td>
		<td><?php echo h($projectactionmail['created']); ?>&nbsp;</td>
		<td><?php echo h($projectactionmail['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $projectactionmail['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'editdefault', $projectactionmail['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectactionmail['id']), null, __('Are you sure you want to delete # %s?', $projectactionmail['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
