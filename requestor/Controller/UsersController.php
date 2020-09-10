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
                return $this->redirect(Redirect::login());
            }
		}

		public function profile() {
			$profile = $this->User->profile($this->Auth->user('id'), array(
				'User.firstname',
				'User.lastname',
				'User.middle_initial',
				'Company.name',
				'Department.name',
				'Project.name',
				'User.username',
				'User.email'
			));

			$this->set('profile', $profile);
		}

		public function edit() {
			$this->profile();
		}

		public function logout() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$this->Auth->logout();

				$response = Output::success(null, null, Redirect::login());
			}

			return Output::response($response);
		}
	}
