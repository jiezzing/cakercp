<?php

	class UsersController extends AppController {
		public $uses = array(
			'User',
			'Rcp'
		);

		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('login');
		}

		public function index() {
			if($this->Auth->loggedIn()) {
				$url = Redirect::dashboard($this->Auth->user('type_id'));

                return $this->redirect($url);
			}

			$currentYear = date('Y');

			$this->set('currentYear', $currentYear);
		}

		public function login() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$hasEmptyField = Validate::login($this->request->data);

				if ($hasEmptyField) {
					$message = Output::message('credential');
					$response = Output::failed($message);
				}
				else {
					$result = $this->User->login($this->request->data);

					if ($result) {
						$this->Auth->login($result['User']);
						$url = $this->params->base . Redirect::dashboard($result['User']['type_id']);
						$response = Output::success(null, null, $url);
					}
					else {
						$message = Output::message('invalidCredential');
						$response = Output::failed($message);
					}
				}
			}

			return Output::response($response);
		}
	}
