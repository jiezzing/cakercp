<?php

	App::uses('Controller', 'Controller');
	App::uses('CakeTime', 'Utility');
	App::uses('CakeNumber', 'Utility');
	App::uses('CakeEmail', 'Network/Email');

	class AppController extends Controller {
		public $components = array(
			'RequestHandler',
			'Session',
			'Auth'
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
			App::uses('Email', 'Lib');

			$currentYear = date('Y');

			$this->set('currentYear', $currentYear);
		}
	}
