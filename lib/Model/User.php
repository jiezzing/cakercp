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
    }
