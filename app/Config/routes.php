<?php

	Router::connect('/login', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/login_user', array('controller' => 'users', 'action' => 'login'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
