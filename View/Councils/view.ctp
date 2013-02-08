<div class="councils view">
<h2><?php  echo __('Council'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($council['Council']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Councilarea'); ?></dt>
		<dd>
			<?php echo $this->Html->link($council['Councilarea']['name'], array('controller' => 'councilareas', 'action' => 'view', $council['Councilarea']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($council['Council']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>