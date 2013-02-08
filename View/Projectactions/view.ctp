<div class="projectactions view">
<h2><?php  echo __('Projectaction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($projectaction['Projectaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projectstep'); ?></dt>
		<dd>
			<?php echo $this->Html->link($projectaction['Projectstep']['name'], array('controller' => 'projectsteps', 'action' => 'view', $projectaction['Projectstep']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projectphase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($projectaction['Projectphase']['name'], array('controller' => 'projectphases', 'action' => 'view', $projectaction['Projectphase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contractor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($projectaction['Contractor']['name'], array('controller' => 'contractors', 'action' => 'view', $projectaction['Contractor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($projectaction['Projectaction']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($projectaction['Projectaction']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>