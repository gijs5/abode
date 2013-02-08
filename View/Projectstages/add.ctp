<p><em>Select the steps you want to use.</em></p>

<div id="steps_list">
<?php echo $this->Form->create('Projectstage'); ?>
<?php foreach ($stage['Projectstep'] as $mandatory => $projectsteps): ?>
	<h3><?php echo ($mandatory ? 'Mandatory' : 'Optional') ?></h3>
	<?php foreach ($projectsteps as $id => $projectstep): ?>
	<div class="item">
		<p>
			<?php if ($mandatory): ?>
				<?php echo $this->Form->input('Projectsteps.'.$id, array('disabled'=>true, 'checked'=>'checked', 'label'=>$projectstep['name'], 'type'=>'checkbox', 'value'=>$projectstep['id'])); ?>
			<?php else: ?>
				<?php echo $this->Form->input('Projectsteps.'.$id, array('label'=>$projectstep['name'], 'type'=>'checkbox', 'value'=>$projectstep['id'])); ?>
			<?php endif ?>
			<br />
			<?php echo $projectstep['description'] ?>
		</p>
	</div>
	<?php endforeach ?>
<?php endforeach ?>
<?php echo $this->Form->end('Start'); ?>
</div>