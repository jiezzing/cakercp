<?php

	// dashboard
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));

	// rcp
	Router::connect('/rcps', array('controller' => 'rcp', 'action' => 'index'));
	Router::connect('/details/*', array('controller' => 'rcp', 'action' => 'details'));

	// users
	Router::connect('/profile/*', array('controller' => 'users', 'action' => 'profile'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
