<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Projects'), array('controller'=>'projects', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rates'), array('controller' => 'rates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Stages / Steps'), array('controller'=>'stages', 'action' => 'index')); ?></li>
	</ul>
	<h5>Users</h5>
	<ul>
		<li><?php echo $this->Html->link(__('Clients'), array('controller'=>'clients', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Contractors'), array('controller' => 'contractors', 'action' => 'index')); ?> </li>
	</ul>
	<h5>Defaults</h5>
	<ul>
		<li><?php echo $this->Html->link(__('Councils'), array('controller' => 'councils', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Countrystates'), array('controller' => 'countrystates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Streettypes'), array('controller' => 'streettypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Streetsuffixes'), array('controller' => 'streetsuffixes', 'action' => 'index')); ?> </li>
	</ul>
	<h5>Administrator</h5>
	<ul>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
	</ul>
</div>