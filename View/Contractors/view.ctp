<div class="contractors view">
<h2><?php  echo __('Contractor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contractor['Contractor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contractor['Contractor']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Council'); ?></dt>
		<dd>
			<?php if (!empty($contractor['Council'])): ?>
				<?php $councils=array(); foreach ($contractor['Council'] as $council): ?>
					<?php $councils[] = $this->Html->link($council['name'], array('controller' => 'councils', 'action' => 'view', $council['id'])); ?>
				<?php endforeach ?>
				<?php echo implode(', ', $councils); ?>
			<?php else: ?>
				No councils selected
			<?php endif ?>
		</dd>
		<dt><?php echo __('Contractortype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($contractor['Contractortype']['name'], array('controller' => 'contractortypes', 'action' => 'view', $contractor['Contractortype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contractor['Contractor']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
