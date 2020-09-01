<?php

	App::uses('Controller', 'Controller');

	class AppController extends Controller {
		public $components = array(
			'RequestHandler',
			'Session',
			'Auth' => array(
				'loginRedirect' => array(
					'controller' => 'home',
					'action' => 'index'
				),
				'logoutRedirect' => array(
					'controller' => 'login',
					'action' => 'index'
				),
				'authenticate' => array(
					'Form' => array(
						'userModel' => 'UserAccount'
					)
				),
				'loginAction' => array(
					'controller' => 'login',
					'action' => 'index'
				)
			)
		);

		public function beforeFilter() {
			parent::beforeFilter();

			// configure path
			App::build(array(
				'Model' => array(CAKE_CORE_INCLUDE_PATH . '/Model/'),
				'Lib' => array(CAKE_CORE_INCLUDE_PATH . '/Lib/')
			));

			// autoload library
			App::uses('Output', 'Lib');
			App::uses('Validate', 'Lib');
			App::uses('Redirect', 'Lib');
		}
	}
