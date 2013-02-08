<h2><?php echo __('Start'); ?></h2>

<?php if (count($actions_not_in_phase) > 0): ?>
	<p>Not all actions are placed in a phase:</p>
	<ul>
		<?php foreach ($actions_not_in_phase as $action_name): ?>
			<li><?php echo $action_name ?></li>
		<?php endforeach ?>
	</ul>
	<p><?php echo $this->Html->link('Phase administration of '.$projectstage['Stage']['name'], array('controller'=>'projectphases', 'action'=>'index', $projectstage['Projectstage']['id'])) ?></p>
<?php else: ?>
	<p>Click below to activate the projectstage and start the first phase of actions.<br />
		<em>After starting the projectstage it is NOT possible to change the order of steps or actions.</em></p>
	<?php echo $this->Form->create('Projectstage', array('action'=>'start')); ?>
	<?php echo $this->Form->input('id', array('value'=>$projectstage['Projectstage']['id'])); ?>
	<?php echo $this->Form->end('Start'); ?>
<?php endif ?>