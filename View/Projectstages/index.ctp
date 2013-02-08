<?php
$this->Html->addCrumb('Projects');
$this->Html->addCrumb($project['Project']['displayname']);
$this->Html->addCrumb('Stages');
?>
<div class="stages index">
	<h2><?php echo __('stages'); ?></h2>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Stage</th>
			<th>State</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($project['Projectstage'] as $projectstage): ?>
	<tr>
		<td><?php echo h($projectstage['Stage']['name']); ?>&nbsp;</td>
		<td><?php echo $state_names[$projectstage['state']]; ?>&nbsp;</td>
		<td class="actions">
			<?php if ($projectstage['state']==0): ?>
				<?php echo $this->Html->link(__('Start'), array('action' => 'check', $projectstage['id'])); ?>
				<?php echo $this->Html->link(__('Action Phasing'), array('controller'=>'projectphases', 'action' => 'index', $projectstage['id'])); ?>
				<?php echo $this->Html->link(__('Steps and Actions'), array('controller'=>'projectsteps', 'action' => 'index', $projectstage['id'])); ?>
			<?php else: ?>
				<?php echo $this->Html->link(__('Status Overview'), array('action' => 'status_overview', $projectstage['id'])); ?>
			<?php endif ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
	<p>Start in: 
	<?php foreach ($stages as $id => $name): ?>
		<?php echo $this->Html->link($name, array('action'=>'add', $project['Project']['id'], $id)) ?>
	<?php endforeach ?>
</div>
