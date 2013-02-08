<?php
$this->Html->addCrumb($projectaction['Projectphase']['Projectstage']['Project']['displayname']);
$this->Html->addCrumb($projectaction['Projectphase']['Projectstage']['Stage']['name']);
$this->Html->addCrumb($projectaction['Projectaction']['name']);
$this->Html->addCrumb('Files');
?>

<div class="projectactionfiles index">
	<h2><?php echo __('Files'); ?></h2>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('New', array('action'=>'add', $projectaction['Projectaction']['id'])) ?>
	</ul>
	
	<div id="projectactionfiles">
	<?php foreach ($projectaction['Projectactionfile'] as $projectactionfile): ?>
		<div class="item">
			<p><?php echo $this->Html->link($projectactionfile['filename'], '/files/projectaction/'.$projectactionfile['filename']) ?><br />
			<?php echo $projectactionfile['comment'] ?></p>
			<p>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectactionfile['id']), null, __('Are you sure you want to delete # %s?', $projectactionfile['filename'])); ?>
				 | 
				<?php echo $this->Html->link('Edit', array('action'=>'edit', $projectactionfile['id'])) ?>
			</p>
		</div>
	<?php endforeach ?>
	</div>
	
</div>