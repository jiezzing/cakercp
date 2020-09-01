<?php

    App::uses('AppModel', 'Model');

    class User extends AppModel {

        public $usesTable = 'users';

		public function profile($id = null, $fields = array()) {
			$result = $this->find('first', array(
				'joins' => array(
					array(
						'alias' => 'Company',
						'table' => 'companies',
						'type' => 'INNER',
						'conditions' => array(
							'Company.id = User.comp_id'
						)
					),
					array(
						'alias' => 'Department',
						'table' => 'departments',
						'type' => 'INNER',
						'conditions' => array(
							'Department.id = User.dept_id'
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
						'alias' => 'UserAccount',
						'table' => 'user_accounts',
						'type' => 'INNER',
						'conditions' => array(
							'UserAccount.user_id = User.id'
						)
					),
				),
				'conditions' => array(
					'User.id' => $id
				),
				'fields' => $fields
			));

			return $result;
		}

		// register new user
		public function registerUser($data = array()) {
			$field = array();

			$this->create();

			$field['comp_id'] = $data['company'];
			$field['dept_id'] = $data['department'];
			$field['proj_id'] = $data['project'];
			$field['type_id'] = $data['userType'];
			$field['firstname'] = $data['firstname'];
			$field['lastname'] = $data['lastname'];
			$field['middle_initial'] = $data['middleInitial'];
			$field['username'] = $data['username'];
			$field['password'] = AuthComponent::password($data['username']);
			$field['verified'] = 0;
			$field['email'] = $data['email'];
			$field['created'] = date('Y-m-d H:i:s');
			$field['status_id'] = 1;

			$this->set($field);

			$result = $this->save();

			return $result;
		}

		// login using username and password
		public function login($data = array()) {
			$result = $this->find('first', array(
					'conditions' => array(
						'User.username' => $data['username'],
						'User.password' => AuthComponent::password($data['password'])
					),
					'fields' => array(
						'User.id',
						'User.type_id'
					)
			));

			return $result;
		}
    }
