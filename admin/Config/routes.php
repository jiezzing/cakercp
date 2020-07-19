<?php
	Router::connect('/', array('controller' => 'login', 'action' => 'index'));

	// dashboard page
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
	// users render create.ctp page
	Router::connect('/create', array('controller' => 'users', 'action' => 'create'));
	// register new user
	Router::connect('/register', array('controller' => 'users', 'action' => 'registerUser'));
	// login
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	// logout
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
