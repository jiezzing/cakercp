<?php

	Router::connect('/', array('controller' => 'login', 'action' => 'index'));
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
	Router::connect('/create', array('controller' => 'users', 'action' => 'create'));
	Router::connect('/register', array('controller' => 'users', 'action' => 'registerUser'));
	Router::connect('/login_user', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/departments', array('controller' => 'departments', 'action' => 'index'));
	Router::connect('/companies', array('controller' => 'companies', 'action' => 'index'));
	Router::connect('/projects', array('controller' => 'projects', 'action' => 'index'));
	Router::connect('/users', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/rcp', array('controller' => 'rcp', 'action' => 'index'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
