<?php

    App::uses('AppModel', 'Model');

    class Rcp extends AppModel {

        public $usesTable = 'rcp';

		public function all($id = 'all', $status = [1, 2, 3])
		{
			$result = $this->find('all', array(
				'joins' => array(
					array(
						'alias' => 'User',
						'table' => 'users',
						'type' => 'INNER',
						'conditions' => array(
							'User.id = Rcp.app_id'
						)
					),
					array(
						'alias' => 'Company',
						'table' => 'companies',
						'type' => 'INNER',
						'conditions' => array(
							'Company.id = Rcp.comp_id'
						)
					),
					array(
						'alias' => 'Department',
						'table' => 'departments',
						'type' => 'INNER',
						'conditions' => array(
							'Department.id = Rcp.dept_id'
						)
					),
					array(
						'alias' => 'Project',
						'table' => 'projects',
						'type' => 'INNER',
						'conditions' => array(
							'Project.id = Rcp.proj_id'
						)
					),
					array(
						'alias' => 'Status',
						'table' => 'status',
						'type' => 'INNER',
						'conditions' => array(
							'Status.id = Rcp.status_id'
						)
					)
				),
				'conditions' => array(
					'Rcp.req_id' => $id,
					'Rcp.status_id' =>  $status
				),
				'fields' => array(
					'User.firstname',
					'User.lastname',
					'Rcp.rcp_no',
					'Department.name',
					'Department.id',
					'Project.name',
					'Project.id',
					'Company.name',
					'Company.id',
					'User.id',
					'Rcp.issued_on',
					'Rcp.created',
					'Status.name',
					'Rcp.status_id'
				)
			));

			return $result;
		}
    }
