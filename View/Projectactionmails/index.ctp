<?php
/*
$this->Html->addCrumb($projectaction['Projectstep']['Stage']['name']);
$this->Html->addCrumb($projectaction['Projectstep']['name']);
$this->Html->addCrumb($projectaction['Projectaction']['name']);
$this->Html->addCrumb('Default Mails');
*/
?>
<div class="projectactionmails index">
	<h2><?php echo __('Projectactionmails'); ?></h2>
	
	<ul>
		<li><?php echo $this->Html->link('New', array('action'=>'add', $projectaction['Projectaction']['id'])) ?>
	</ul>
	
	<p>Contractor "<?php echo $projectaction['Contractor']['name'] ?>" is linked to this action.</p>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Subject</th>
			<th>Created</th>
			<th>Modified</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($projectaction['Projectactionmail'] as $projectactionmail): ?>
	<tr>
		<td><?php echo h($projectactionmail['subject']); ?>&nbsp;</td>
		<td><?php echo h($projectactionmail['created_dt']); ?>&nbsp;</td>
		<td><?php echo h($projectactionmail['modified_dt']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $projectactionmail['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $projectactionmail['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectactionmail['id']), null, __('Are you sure you want to delete # %s?', $projectactionmail['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
