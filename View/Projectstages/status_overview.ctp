<h2>Status overview <?php echo $projectstage['Project']['displayname'] ?> stage <?php echo $projectstage['Stage']['name'] ?></h2>

<ul>
<?php foreach ($projectstage['Projectphase'] as $projectphase): ?>
	<li class="list_phase_state_<?php echo $projectphase['state'] ?>">
		<?php echo $projectphase['name'] ?> 
		(<span class="phase_state_<?php echo $projectphase['state'] ?>"><?php echo $phase_state_names[$projectphase['state']] ?></span>)
		<?php
		if ($projectphase['state']==1) {
			echo $this->Form->postLink(__('Finish'), array('controller'=>'projectphases', 'action'=>'finish', $projectphase['id']), null, __('Are you sure you want to finish # %s?', $projectphase['name']));
		}
		if ($projectphase['state']==0) {
			echo $this->Form->postLink(__('Start'), array('controller'=>'projectphases', 'action'=>'start', $projectphase['id']), null, __('Are you sure you want to start # %s and send the mails?', $projectphase['name']));
		}
		?>
		<ul>
		<?php foreach ($projectphase['Projectaction'] as $projectaction): ?>
			<li>
				<?php echo $this->Html->link($projectaction['name'], array('controller'=>'projectactions', 'action'=>'view', $projectaction['id'])) ?>
				(<span class="action_state_<?php echo $projectaction['state'] ?>"><?php echo $action_state_names[$projectaction['state']] ?></span>)
				<?php 
				if ($projectaction['state']==1) {
					echo $this->Form->postLink(__('Finish'), array('controller'=>'projectactions', 'action'=>'finish', $projectaction['id']), null, __('Are you sure you want to finish # %s?', $projectaction['name']));
					echo ' | ';
					echo $this->Html->link('Files', array('controller'=>'projectactionfiles', 'action'=>'index', $projectaction['id']));
				}
				?>
				<ul>
				<?php foreach ($projectaction['Projectactionmail'] as $projectactionmail): ?>
					<li><?php echo $this->Html->link('Mail '.$projectactionmail['id'], array('controller'=>'projectactionmails', 'action'=>'view', $projectactionmail['id'])) ?>
						<ul>
						<?php foreach ($projectactionmail['ContractorsProjectactionmail'] as $contractorsprojectactionmail): ?>
							<li class="tooltip" title="Last send <?php echo $contractorsprojectactionmail['last_send_dt'] ?>">
								<?php echo $contractorsprojectactionmail['Contractor']['name'] ?> 
								(<span class="mail_state_<?php echo $contractorsprojectactionmail['state'] ?>">
									<?php echo $mail_state_names[$contractorsprojectactionmail['state']] ?>
								</span>)
								<?php if ($contractorsprojectactionmail['state']>0) echo $this->Form->postLink(__('Send again'), array('controller'=>'projectactionmails', 'action'=>'send_single', $contractorsprojectactionmail['id']), null, __('Are you sure you want to send the mail to # %s again?', $contractorsprojectactionmail['Contractor']['name'])); ?>
							</li>
						<?php endforeach ?>
						</ul>
					</li>
				<?php endforeach ?>
				</ul>
			</li>
		<?php endforeach ?>
		</ul>
	</li>
<?php endforeach ?>
</ul>