<?php
	Router::connect('/', array('controller' => 'login', 'action' => 'index'));

	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
	Router::connect('/create', array('controller' => 'users', 'action' => 'create'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';