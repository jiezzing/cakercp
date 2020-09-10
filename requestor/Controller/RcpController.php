<?php

	class RcpController extends AppController {

		public $uses = array(
			'Approver',
			'Company',
			'Department',
			'Project',
			'Rcp',
			'RcpParticular',
			'RcpRush',
			'RcpApprover',
			'RcpVatable',
			'Notification',
			'User',
			'Vat'
		);

		public $joinCondition = null;

		public function beforeFilter() {
			parent::beforeFilter();

			$this->joinCondtion = array(
				'alias' => 'User',
				'table' => 'users',
				'type' => 'INNER',
				'conditions' => array(
					'User.id = Rcp.app_id'
				)
			);
		}

		// rcp index / dashboard
		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$condition = array(
				'Rcp.req_id' => $this->Auth->user('id')
			);

			$rcps = $this->Rcp->details($condition, 'all', $this->joinCondtion);

			$this->set('rcps', $rcps);
		}

		// shows the rcp details
		public function details($id = null) {
			$condition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.id' =>  $id
			);

			$details = $this->Rcp->details($condition, 'first', $this->joinCondtion);

			if (empty($details)) {
				$this->layout = 'error500';
			}

			$particulars = $this->Rcp->particulars($id);
			$rush = $this->Rcp->rush($id);
			$vats = $this->RcpVatable->details($id);

			if ($rush) {
				$this->set('rush', $rush['RcpRush']);
			}
			else {
				$rush = array(
					'due_date' => '---',
					'justification' => '---'
				);

				$this->set('rush', $rush);
			}

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('vat', $vats);
		}

		// edit rcp
		public function edit($id = null) {
			$condition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.id' =>  $id
			);

			$details = $this->Rcp->details($condition, 'first', $this->joinCondtion);
			$particulars = $this->Rcp->particulars($id, $this->Auth->user('id'));
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');
			$rush = $this->Rcp->rush($id, $this->Auth->user('id'));
			$projects = $this->Project->find('all');
			$vatables = $this->Vat->find('all');
			$vats = $this->RcpVatable->details($id);

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
			$this->set('rush', $rush);
			$this->set('vat', $vats);
			$this->set('vatables', $vatables);
		}

		// display the creat rcp page
		public function create() {
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');
			$vats = $this->Vat->find('all');

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
			$this->set('vats', $vats);
		}

		// creates rcp, particulars, rush rcp, send push notification and email to approver when sending rcp
		public function sendRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$rcpEmpty = Validate::rcp($this->request->data);
				$rushEmpty = Validate::rush($this->request->data);
				$isRush = Validate::isRush($this->request->data);
				$particularsEmpty = Validate::particulars($this->request->data);
				$allApproverSet = true;

				if ($rcpEmpty) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				elseif ($particularsEmpty) {
					$message = Output::message('particularsEmpty');
					$response = Output::failed($message);
				}
				elseif ($rushEmpty) {
					$message = Output::message('rush');
					$response = Output::failed($message);
				}
				else {
					$approver = $this->Approver->currentApprover($this->request->data['department']);

					if ($this->request->data['expenseType'] == "DEPARTMENT EXPENSE") {
						$approverId = $approver['Approver']['app_id'];
					}
					else {
						$approverId= $approver['Approver']['sec_id'];
					}

					$rcpNo = $this->rcpNo($this->request->data['department']);

					$this->request->data['rcp_no'] = $rcpNo;
					$this->request->data['req_id'] = $this->Auth->user('id');
					$this->request->data['app_id'] = $approverId;
					$this->request->data['is_rush'] = (int)$isRush;

					$result = $this->Rcp->store($this->request->data);

					if ($result) {
						$this->request->data['rcp_id'] = $result['Rcp']['id'];

						$this->RcpParticular->store($this->request->data);

						if ($isRush) {
							$this->RcpRush->store($this->request->data);
						}

						$email = array();
						$email['rcp_id'] = $result['Rcp']['id'];
						$email['app_id'] = $result['Rcp']['app_id'];

						$this->sendEmail($email);
						$this->RcpApprover->newApprover($result['Rcp']['id'], $approver['Approver']['app_id']);

						if ($this->request->data['isVatable'] == 'true') {
							$this->RcpVatable->store($this->request->data);
						}

						$message = Output::message('rcp');
						$response = Output::success($message);
					}
					else {
						$message = Output::message('error');
						$response = Output::failed($message);
					}

					$response['rcp_no'] = $rcpNo;
				}
			}

			return Output::response($response);
		}

		// update rcp
		public function updateRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$updateRcpHasEmptyFields = Validate::updateRcpHasEmptyFields($this->request->data);
				$hasRushEmptyField = Validate::hasRushEmptyField($this->request->data);
				$isRush = Validate::isRush($this->request->data);
				$rcpParticularsIsEmpty = Validate::rcpParticularsIsEmpty($this->request->data);

				if ($updateRcpHasEmptyFields) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				elseif ($rcpParticularsIsEmpty) {
					$message = Output::message('particularsEmpty');
					$response = Output::failed($message);
				}
				elseif ($hasRushEmptyField) {
					$message = Output::message('rush');
					$response = Output::failed($message);
				}
				else {
					$updateRcp = $this->Rcp->updateAll(array(
						'Rcp.comp_id' => $this->request->data['company'],
						'Rcp.proj_id' => $this->request->data['project'],
						'Rcp.payee' => "'{$this->request->data['payee']}'",
						'Rcp.amount' => preg_replace('/[^\d.]/', '', $this->request->data['totalAmount']),
						'Rcp.amount_in_words' => "'{$this->request->data['amountInWords']}'",
						'Rcp.expense_type' => "'{$this->request->data['expenseType']}'"
					), array(
						'Rcp.id' => $this->request->data['id']
					));

					if ($updateRcp) {
						$this->RcpParticular->deleteAll(array(
							'RcpParticular.rcp_id' => $this->request->data['id'],
						), false);

						$this->createRcpParticulars(
							$this->request->data['id'],
							$this->request->data
						);

						if ($isRush) {
							$hasRushRecord = $this->RcpRush->hasAny(array(
								'RcpRush.rcp_id' => $this->request->data['id']
							));

							if ($hasRushRecord) {
								$dueDate = date('Y-m-d', strtotime($this->request->data['dueDate']));

								$this->RcpRush->updateAll(array(
									'RcpRush.due_date' => "'{$dueDate}'",
									'RcpRush.justification' => "'{$this->request->data['justification']}'"
								), array(
									'RcpRush.rcp_id' => $this->request->data['id']
								));
							}
							else {
								$this->createRushRcp($this->request->data['id'], $this->request->data);
							}
						}
						else {
							$this->RcpRush->deleteAll(array(
								'RcpRush.rcp_id' => $this->request->data['id']
							), false);
						}

						$message = Output::message('updated');
						$response = Output::success($message);
					}
					else {
						$message = Output::message('failed');
						$response = Output::failed($message);
					}
				}
			}

			return Output::response($response);
		}

		// send an email to the approver
		public function sendEmail($data = array()) {
			$email = array();
			$fields = array(
				'User.firstname',
				'User.lastname',
				'User.email'
			);
			$approver = $this->User->profile($data['app_id'], $fields);
			$requestor = $this->User->profile($this->Auth->user('id'), $fields);
			$condition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.id' => $data['rcp_id']
			);
			$rcpDetails = $this->Rcp->details(
				$condition,
				'first',
				$this->joinCondtion
			);
			$rush = $this->Rcp->rush($data['rcp_id']);

			$email['template'] = 'approval';
			$email['recepient'] = $approver['User']['email'];
			$email['subject'] = "Request for Check Payment Approval";
			$email['viewVars'] = array(
				'approver' => $approver,
				'requestor' => $requestor,
				'rcpDetails' => $rcpDetails,
				'rush' => $rush
			);

			Email::send($email);
		}

		// generates the RCP code
		public function rcpNo($id = null) {
			if ($id) {
				$departmentCode = $this->Department->find('first', array(
					'conditions' => array('Department.id' => $id),
					'fields' => array('Department.code')
				));
				$totalRcp = $this->Rcp->find('count', array(
					'conditions' => array('Rcp.dept_id' => $id)
				));

				return $departmentCode['Department']['code'] . ' ' . substr(date('y'), -2) . '-' . str_pad(($totalRcp + 1), 4, '0', STR_PAD_LEFT);
			}
		}

		public function approvers() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$approver = $this->Approver->currentApprover($this->request->data['id']);
				$approverSet = true;

				if ($this->request->data['expenseType'] == "DEPARTMENT EXPENSE") {
					if (empty($approver['Approver']['app_id']) || empty($approver['Approver']['alt_app_id']) ||
					empty($approver['Approver']['sec_id']) || empty($approver['Approver']['alt_sec_id'])) {
						$approverSet = false;
					}
				}
				else {
					if (empty($approver['Approver']['sec_id']) || empty($approver['Approver']['alt_sec_id'])) {
						$approverSet = false;
					}
				}

				if ($approverSet) {
					$message = Output::message('approverSet');
					$response = Output::success($message);
				}
				else {
					$message = Output::message('approverNotSet');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}
	}
