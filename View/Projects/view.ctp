<div class="projects view">
<h2><?php  echo __('Project'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($project['Project']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Client']['name'], array('controller' => 'clients', 'action' => 'view', $project['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Countrystate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Countrystate']['name'], array('controller' => 'countrystates', 'action' => 'view', $project['Countrystate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['State']['name'], array('controller' => 'states', 'action' => 'view', $project['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Streettype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Streettype']['name'], array('controller' => 'streettypes', 'action' => 'view', $project['Streettype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Streetsuffix'); ?></dt>
		<dd>
			<?php echo $this->Html->link($project['Streetsuffix']['name'], array('controller' => 'streetsuffixes', 'action' => 'view', $project['Streetsuffix']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Streetnumber'); ?></dt>
		<dd>
			<?php echo h($project['Project']['streetnumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Streetname'); ?></dt>
		<dd>
			<?php echo h($project['Project']['streetname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postalcode'); ?></dt>
		<dd>
			<?php echo h($project['Project']['postalcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Suburb'); ?></dt>
		<dd>
			<?php echo h($project['Project']['suburb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($project['Project']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contactname'); ?></dt>
		<dd>
			<?php echo h($project['Project']['contactname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contactphone'); ?></dt>
		<dd>
			<?php echo h($project['Project']['contactphone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($project['Project']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($project['Project']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>