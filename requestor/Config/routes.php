<?php
	Router::connect('/', array('controller' => 'dashboard', 'action' => 'index'));

	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));

	// rcp
	Router::connect('/create', array('controller' => 'rcp', 'action' => 'create'));
	Router::connect('/send_rcp', array('controller' => 'rcp', 'action' => 'sendRcp'));
	Router::connect('/rcps', array('controller' => 'rcp', 'action' => 'index'));
	Router::connect('/details/*', array('controller' => 'rcp', 'action' => 'details'));
	Router::connect('/edit/*', array('controller' => 'rcp', 'action' => 'edit'));
	Router::connect('/update_rcp', array('controller' => 'rcp', 'action' => 'updateRcp'));
	Router::connect('/approvers', array('controller' => 'rcp', 'action' => 'approvers'));

	// users
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/update_player_id', array('controller' => 'users', 'action' => 'updatePlayerId'));
	Router::connect('/profile', array('controller' => 'users', 'action' => 'profile'));
	Router::connect('/profile/edit', array('controller' => 'users', 'action' => 'edit'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
