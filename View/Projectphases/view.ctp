<div class="projectphases view">
<h2><?php  echo __('Projectphase'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projectstage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($projectphase['Projectstage']['name'], array('controller' => 'projectstages', 'action' => 'view', $projectphase['Projectstage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($projectphase['Project']['description'], array('controller' => 'projects', 'action' => 'view', $projectphase['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['rank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($projectphase['Projectphase']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>