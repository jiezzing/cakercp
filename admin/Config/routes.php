<?php

	Router::connect('/', array('controller' => 'login', 'action' => 'index'));

	Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));

	// users
	Router::connect('/create', array('controller' => 'users', 'action' => 'create'));
	Router::connect('/register', array('controller' => 'users', 'action' => 'registerUser'));
	Router::connect('/login_user', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/users', array('controller' => 'users', 'action' => 'index'));

	// departments
	Router::connect('/departments', array('controller' => 'departments', 'action' => 'index'));
	Router::connect('/save_department', array('controller' => 'departments', 'action' => 'store'));
	Router::connect('/delete_department', array('controller' => 'departments', 'action' => 'delete'));
	Router::connect('/edit_department', array('controller' => 'departments', 'action' => 'edit'));
	Router::connect('/update_department', array('controller' => 'departments', 'action' => 'update'));

	// companies
	Router::connect('/companies', array('controller' => 'companies', 'action' => 'index'));

	// projects
	Router::connect('/projects', array('controller' => 'projects', 'action' => 'index'));

	// rcp
	Router::connect('/rcp', array('controller' => 'rcp', 'action' => 'index'));

	// approvers
	Router::connect('/approvers', array('controller' => 'approvers', 'action' => 'index'));
	Router::connect('/remove', array('controller' => 'approvers', 'action' => 'removeAllApprovers'));
	Router::connect('/edit/*', array('controller' => 'approvers', 'action' => 'edit'));
	Router::connect('/update_approver', array('controller' => 'approvers', 'action' => 'updateApprover'));

	CakePlugin::routes();

	require CAKE . 'Config' . DS . 'routes.php';
