<?php

    App::uses('AppModel', 'Model');

    class Rcp extends AppModel {

		public $usesTable = 'rcp';

		// all requestor rcp
		public function allRcp($conditions = array()) {
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
				'conditions' => $conditions,
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
					'Rcp.status_id',
					'Rcp.id'
				)
			));

			return $result;
		}

		// requestor rcp details
		public function rcpDetails($id = null) {
			$result = $this->find('first', array(
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
						'alias' => 'UserAccount',
						'table' => 'user_accounts',
						'type' => 'INNER',
						'conditions' => array(
							'UserAccount.user_id = User.id'
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
					'Rcp.id' =>  $id
				),
				'fields' => array(
					'Rcp.id',
					'Rcp.rcp_no',
					'Rcp.dept_id',
					'Rcp.comp_id',
					'Rcp.proj_id',
					'Rcp.issued_on',
					'Rcp.created',
					'Rcp.amount',
					'Rcp.payee',
					'Rcp.expense_type',
					'Rcp.created',
					'Rcp.is_rush',
					'Rcp.amount_in_words',
					'Status.name',
					'User.firstname',
					'User.lastname',
					'UserAccount.email',
					'UserAccount.player_id',
					'Department.name',
					'Project.name',
					'Company.name'
				)
			));

			return $result;
		}

		// request rcp particulars
		public function rcpParticulars($id = null) {
			$result = $this->find('all', array(
				'joins' => array(
					array(
						'alias' => 'RcpParticular',
						'table' => 'rcp_particulars',
						'type' => 'INNER',
						'conditions' => array(
							'RcpParticular.rcp_id = Rcp.id',
						)
					)
				),
				'conditions' => array(
					'Rcp.id' => $id
				),
				'fields' => array(
					'RcpParticular.qty',
					'RcpParticular.unit',
					'RcpParticular.particulars',
					'RcpParticular.ref_code',
					'RcpParticular.code',
					'RcpParticular.amount'
				)
			));

			return $result;
		}

		// requestor rcp rush
		public function rcpRush($id = null) {
			$result = $this->find('first', array(
				'joins' => array(
					array(
						'alias' => 'RcpRush',
						'table' => 'rcp_rushes',
						'type' => 'INNER',
						'conditions' => array(
							'RcpRush.rcp_id = Rcp.id'
						)
					)
				),
				'conditions' => array(
					'Rcp.id' => $id
				),
				'fields' => array(
					'RcpRush.due_date',
					'RcpRush.justification',
					'RcpRush.supporting_file'
				)
			));

			return $result;
		}
    }
