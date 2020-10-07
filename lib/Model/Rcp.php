<?php

    App::uses('AppModel', 'Model');

    class Rcp extends AppModel {

		public $usesTable = 'rcp';

		// all requestor rcp
		public function details($conditions = array(), $query = null, $pushJoinCondition = array()) {
			$joinArray = array(
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
			);

			if (count($pushJoinCondition)) {
				array_push($joinArray, $pushJoinCondition);
			}

			return $this->find($query, array(
				'joins' => $joinArray,
				'conditions' => $conditions,
				'fields' => array(
					'Rcp.id',
					'Rcp.rcp_no',
					'Rcp.status_id',
					'Rcp.issued_on',
					'Rcp.created',
					'Rcp.payee',
					'Rcp.expense_type',
					'Rcp.is_rush',
					'Rcp.amount',
					'Rcp.amount_in_words',
					'User.id',
					'User.firstname',
					'User.lastname',
					'Department.id',
					'Department.name',
					'Project.id',
					'Project.name',
					'Company.id',
					'Company.name',
					'Status.name',
				)
			));
		}

		public function particulars($id = null) {
			return $this->find('all', array(
				'joins' => array(
					array(
						'alias' => 'RcpParticular',
						'table' => 'rcp_particulars',
						'type' => 'INNER',
						'conditions' => array(
							'RcpParticular.Rcp_id = Rcp.id'
						)
					)
				),
				'conditions' => array(
					'Rcp.id' =>  $id
				),
				'fields' => array(
					'RcpParticular.qty',
					'RcpParticular.unit',
					'RcpParticular.particulars',
					'RcpParticular.ref_code',
					'RcpParticular.code',
					'RcpParticular.amount',
				)
			));
		}

		// requestor rcp rush
		public function rush($id = null) {
			return $this->find('first', array(
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
		}

		public function store($data = array()) {
			$rcp = array();

			$this->create();

			$rcp['rcp_no'] = $data['rcp_no'];
			$rcp['req_id'] = $data['req_id'];
			$rcp['app_id'] = $data['app_id'];
			$rcp['comp_id'] = $data['company'];
			$rcp['dept_id'] = $data['department'];
			$rcp['proj_id'] = $data['project'];
			$rcp['payee'] = $data['payee'];
			$rcp['issued_on'] = date('Y-m-d');
			$rcp['amount'] = preg_replace('/[^\d.]/', '', $data['totalAmount']);
			$rcp['amount_in_words'] = $data['amountInWords'];
			$rcp['expense_type'] = $data['expenseType'];
			$data['isVatable'] == true ? $rcp['is_vatable'] = 1 : $rcp['is_vatable'] = 0;
			empty($data['is_rush']) ? $rcp['is_rush'] = 0 : $rcp['is_rush'] = 1;
			$rcp['is_edited'] = 0;
			$rcp['created'] = date('Y-m-d H:i:s');
			$rcp['status_id'] = 1;

			$this->set($rcp);

			$result = $this->save();

			return $result;
		}

		public function tally($id = null) {
			$pending = $this->find('count', array(
				'conditions' => array(
					'Rcp.req_id' => $id,
					'Rcp.status_id' => 1
				)
			));

			$approved = $this->find('count', array(
				'conditions' => array(
					'Rcp.req_id' => $id,
					'Rcp.status_id' => 2
				)
			));

			$declined = $this->find('count', array(
				'conditions' => array(
					'Rcp.req_id' => $id,
					'Rcp.status_id' => 3
				)
			));

			$all = $this->find('count', array(
				'conditions' => array('Rcp.req_id' => $id)
			));

			return array(
				'pending' => $pending,
				'approved' => $approved,
				'declined' => $declined,
				'all' => $all
			);
		}
    }
