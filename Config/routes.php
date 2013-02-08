<?php
	// home
	Router::connect('/', array('controller' => 'projects', 'action' => 'index'));
	
	// dont change
	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
