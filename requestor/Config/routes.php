<?php

	Router::connect('/', array('controller' => 'login', 'action' => 'index'));
	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
	Router::connect('/create', array('controller' => 'rcp', 'action' => 'create'));
	Router::connect('/login_user', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/dept_approvers', array('controller' => 'rcp', 'action' => 'approvers'));
	Router::connect('/expense_type', array('controller' => 'rcp', 'action' => 'expenseType'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
