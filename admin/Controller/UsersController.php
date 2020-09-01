<?php

	class UsersController extends AppController {
		public $uses = array(
			'Company',
			'Department',
			'Project',
			'UserType',
			'User'
		);

		public function beforeFilter() {
			parent::beforeFilter();

			$this->Auth->allow('login');
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$users = $this->User->find('all', array(
				'joins' => array(
					array(
        				'alias' => 'Department',
        				'table' => 'departments',
        				'type' => 'INNER',
        				'conditions' => array(
        					'Department.id = User.dept_id'
        				)
					),
					array(
        				'alias' => 'Company',
        				'table' => 'companies',
        				'type' => 'INNER',
        				'conditions' => array(
        					'Company.id = User.comp_id'
        				)
					),
					array(
        				'alias' => 'Project',
        				'table' => 'projects',
        				'type' => 'INNER',
        				'conditions' => array(
        					'Project.id = User.proj_id'
        				)
					),
					array(
        				'alias' => 'UserType',
        				'table' => 'user_types',
        				'type' => 'INNER',
        				'conditions' => array(
        					'UserType.id = User.type_id'
        				)
        			),
					array(
        				'alias' => 'UserAccount',
        				'table' => 'user_accounts',
        				'type' => 'INNER',
        				'conditions' => array(
        					'UserAccount.user_id = User.id'
        				)
        			)
				),
				'fields' => array(
					'User.firstname',
					'User.lastname',
					'User.middle_initial',
					'User.created',
					'User.modified',
					'Department.name',
					'Project.name',
					'Company.name',
					'UserType.name',
					'UserAccount.username',
					'UserAccount.password',
					'UserAccount.email',
					'UserAccount.log_count'
				)
			));

			$this->set('users', $users);
		}

		public function create() {
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');
			$userTypes = $this->UserType->find('all');

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
			$this->set('userTypes', $userTypes);
		}

		public function registerUser() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$hasEmptyField = Validate::registerEmptyField($this->request->data);

				if ($hasEmptyField) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				else {
					$result = $this->User->registerUser($this->request->data);

					if ($result) {
						$message = Output::message('register');
						$response = Output::success($message);
					}
					else {
						$message = Output::failed('error');
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
