<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb($projectstep['Projectstage']['Project']['displayname']);
$this->Html->addCrumb($projectstep['Projectstage']['Stage']['name']);
$this->Html->addCrumb($projectstep['Projectstep']['name']);
$this->Html->addCrumb('Actions');
?>
<div class="projectactions index">
	<h2><?php echo __('Actions'); ?></h2>
	
	<p><em>The actions to be activated when step <?php echo $projectstep['Projectstep']['name'] ?> is selected.</em></p>
	
	<ul>
		<li><?php echo $this->Html->link('New', array('action'=>'add', $projectstep['Projectstep']['id'])) ?>
	</ul>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Name</th>
			<th>Duration (days)</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($projectstep['Projectaction'] as $projectaction): ?>
	<tr>
		<td><?php echo h($projectaction['name']); ?>&nbsp;</td>
		<td><?php echo $projectaction['duration']; ?> days&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Mails'), array('controller'=>'projectactionmails', 'action' => 'index', $projectaction['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $projectaction['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectaction['id']), null, __('Are you sure you want to delete # %s?', $projectaction['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
