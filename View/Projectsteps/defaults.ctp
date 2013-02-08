<?php $this->html->scriptBlock('$(function() { createTableSortable("#sortableTable", "projectsteps/sort"); });', array('inline'=>false)) ?>
<?php
$this->Html->addCrumb($stage['Stage']['name']);
$this->Html->addCrumb('Default Projectsteps');
?>

<div class="projectsteps index">
	<h2><?php echo __('Projectsteps'); ?></h2>
	
	<p><em>List of items shown on the quote for the client. Click on "Actions" to change the actions and mails per step.</em></p>
	
	<ul>
		<li><?php echo $this->Html->link('New', array('action'=>'adddefault', $stage['Stage']['id'])) ?>
	</ul>
	
	<div id="JQresult">
		Sorting status
	</div>
	
	<table cellpadding="0" cellspacing="0" id="sortableTable">
	<tr>
			<th>#</th>
			<th>Name</th>
			<th>Mandatory</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($stage['Projectstep'] as $projectstep): ?>
	<tr id="projectstep_<?php echo $projectstep['id'] ?>">
		<td>
			<?php echo $this->Html->link('Sort', '#', array('class'=>'handle')) ?>
		</td>
		<td>
			<?php echo h($projectstep['name']); ?>
		</td>
		<td>
			<?php echo h($projectstep['mandatory']); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Default Actions'), array('controller'=>'projectactions', 'action' => 'defaults', $projectstep['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'editdefault', $projectstep['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectstep['id']), null, __('Are you sure you want to delete # %s?', $projectstep['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>