<?php

	Router::connect('/', array('controller' => 'login', 'action' => 'index'));
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
	Router::connect('/create', array('controller' => 'rcp', 'action' => 'create'));
	Router::connect('/login_user', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/dept_approvers', array('controller' => 'rcp', 'action' => 'approvers'));
	Router::connect('/send_rcp', array('controller' => 'rcp', 'action' => 'sendRcp'));
	Router::connect('/rcp_no', array('controller' => 'rcp', 'action' => 'rcpNo'));
	Router::connect('/rcps', array('controller' => 'rcp', 'action' => 'index'));
	Router::connect('/details/*', array('controller' => 'rcp', 'action' => 'details'));
	Router::connect('/edit/*', array('controller' => 'rcp', 'action' => 'edit'));
	Router::connect('/update_player_id', array('controller' => 'users', 'action' => 'updatePlayerId'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
