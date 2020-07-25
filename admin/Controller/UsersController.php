<?php

	class UsersController extends AppController {
		public $uses = array(
			'Company',
			'Department',
			'Project',
			'UserType',
			'User',
			'UserAccount'
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
					$this->User->create();

					$data['comp_id'] = $this->request->data['company'];
					$data['dept_id'] = $this->request->data['department'];
					$data['proj_id'] = $this->request->data['project'];
					$data['type_id'] = $this->request->data['userType'];
					$data['firstname'] = $this->request->data['firstname'];
					$data['lastname'] = $this->request->data['lastname'];
					$data['middle_initial'] = $this->request->data['middleInitial'];
					$data['created'] = date('Y-m-d H:i:s');
					$data['status_id'] = 1;

					$this->User->set($data);

					$result = $this->User->save();

					if ($result) {
						$this->UserAccount->create();

						$data['user_id'] = $result['User']['id'];
						$data['username'] = $this->request->data['username'];
						$data['password'] = AuthComponent::password($this->request->data['username']);
						$data['log_count'] = 0;
						$data['email'] = $this->request->data['email'];

						$this->UserAccount->save($data);

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
