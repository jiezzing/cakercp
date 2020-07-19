<?php

	class UsersController extends AppController {
		public $uses = array(
			'User',
			'UserAccount'
		);

		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('login');
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->logoutRedirect);
            }
		}

		public function login() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$hasEmptyField = Validate::loginEmptyField($this->request->data);

				if ($hasEmptyField) {
					$message = Output::message('credential');
					$response = Output::failed($message);
				}
				else {

					$result = $this->UserAccount->loginByUsernameAndPassword(
						$this->request->data['username'],
						AuthComponent::password($this->request->data['password'])
					);

					if ($result) {
						$this->Auth->login($result['User']);


						$url = $this->params->base . '/dashboard';
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

		public function logout() {
			$this->Auth->logout();

			return $this->redirect($this->Auth->logoutRedirect);
		}
	}
