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
        }

		public function create() {
			$companies = $this->Company->all();
			$departments = $this->Department->all();
			$projects = $this->Project->all();
			$userTypes = $this->UserType->all();

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
						$data['password'] = 'password123';
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
	}
