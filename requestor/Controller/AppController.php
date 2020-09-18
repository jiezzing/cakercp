<?php

	App::uses('Controller', 'Controller');
	App::uses('CakeTime', 'Utility');
	App::uses('CakeNumber', 'Utility');
	App::uses('CakeEmail', 'Network/Email');

	class AppController extends Controller {
		public $components = array(
			'RequestHandler' => array(
				'viewClassMap' => array(
					'pdf' => 'CakeTCPDF.Pdf'
				)
			),
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
			$user = ClassRegistry::init('User');

			$profile = $user->profile($this->Auth->user('id'));

			is_null($profile['User']['middle_initial']) ?
				$name = $profile['User']['firstname'] . ' ' . $profile['User']['lastname'] :
				$name = $profile['User']['firstname'] . ' ' . $profile['User']['middle_initial'] . '. ' . $profile['User']['lastname'];

			$this->set('currentYear', $currentYear);
			$this->set('name', $name);
		}
	}
