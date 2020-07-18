<?php

	App::uses('Controller', 'Controller');

	class AppController extends Controller {

		public function beforeFilter() {
			parent::beforeFilter();

			// configure path
			App::build(array(
			  'Model' => array(CAKE_CORE_INCLUDE_PATH . '/Model/'),
			  'Lib' => array(CAKE_CORE_INCLUDE_PATH . '/Lib/')
			));

			// autoload library
			App::uses('Output', 'Lib');
		}
	}
