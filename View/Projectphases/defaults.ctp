<?php $this->html->scriptBlock('$(function() { projectphases(); });', array('inline'=>false)) ?>
<?php
$this->Html->addCrumb($stage['Stage']['name']);
$this->Html->addCrumb('Default action phasing');
?>
<div class="projectsteps index">
	<h2>Project phasing</h2>
	
	<p><em>After creating the actions in the steps, you can sort the phasing below by draging and dropping the actions in the right phase.</em></p>
	
	<ul class="page-menu">
		<li><?php echo $this->Html->link('Add phase in '.$stage['Stage']['name'], array('action'=>'adddefault', $stage['Stage']['id'])) ?>
	</ul>
	
	<div id="JQresult">
		Sorting status
	</div>
	
	<div id="projectphases" class="coll-left">
		
		<?php if (isset($stage['Projectphase']) && !empty($stage['Projectphase'])): ?>
		
			<?php foreach ($stage['Projectphase'] as $projectphase): ?>
				
				<div class="projectphase-item" id="projectphase_<?php echo $projectphase['id'] ?>">
					<h4>
						<span class="handle">Sort</span>&nbsp;
						<?php echo $projectphase['name'] ?>
						<?php echo $this->Html->link('Edit', array('action'=>'editdefault', $projectphase['id'])) ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $projectphase['id']), null, __('Are you sure you want to delete # %s?', $projectphase['name'])); ?>
					</h4>
					<ul class="droptrue" id="projectphase_<?php echo $projectphase['id'] ?>">
						<?php if (isset($projectactions[$projectphase['id']])): ?>
							<?php foreach ($projectactions[$projectphase['id']] as $id => $projectaction): ?>
								<li id="projectaction_<?php echo $projectaction['id'] ?>"><?php echo $projectaction['name'] ?></li>
							<?php endforeach ?>
						<?php endif ?>
					</ul>
				</div>
				
			<?php endforeach ?>
		
		<?php else: ?>
			
			<p><em>No projectphases found</em></p>
		
		<?php endif ?>
			
	</div>
	
	<div id="projectactions" class="coll-right">
		<h4>Not yet in phase:</h4>
		<ul class="droptrue" id="projectphase_0">
			<?php if (isset($projectactions[0])): ?>
				<?php foreach ($projectactions[0] as $id => $projectaction): ?>
					<li id="projectaction_<?php echo $projectaction['id'] ?>"><?php echo $projectaction['name'] ?></li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>
</div>