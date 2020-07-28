<?php

	class UsersController extends AppController {
		public $uses = array(
			'UserAccount'
		);

		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('login');
		}

		public function index() {
			if($this->Auth->loggedIn()) {
				if ($this->Auth->user('type_id') == 1) {
					$url = $this->params->webroot . 'admin/dashboard';
				}
				else if ($this->Auth->user('type_id') == 2) {
					$url = $this->params->webroot . 'requestor/dashboard';
				}
				else {
					$url = $this->params->webroot . 'approver/dashboard';
				}
                return $this->redirect("/requestor/dashboard");
            }
			$currentYear = date('Y');

			$this->set('currentYear', $currentYear);
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

						if ($result['User']['type_id'] == 1) {
							$url = $this->params->webroot . 'admin/dashboard';
						}
						else if ($result['User']['type_id'] == 2) {
							$url = $this->params->webroot . 'requestor/dashboard';
						}
						else {
							$url = $this->params->webroot . 'approver/dashboard';
						}

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
