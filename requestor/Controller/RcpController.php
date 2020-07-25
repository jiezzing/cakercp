<?php

	class RcpController extends AppController {

		public $uses = array(
			'Company',
			'Project',
			'Department',
			'Approver',
			'Rcp',
			'RcpParticular',
			'RcpRush',
			'User',
			'Notification'
		);

		public function beforeFilter() {
            parent::beforeFilter();
		}

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$rcps = $this->Rcp->all($this->Auth->user('id'));
			$pending = $this->Rcp->all($this->Auth->user('id'), 1);
			$approved = $this->Rcp->all($this->Auth->user('id'), 2);
			$declined = $this->Rcp->all($this->Auth->user('id'), 3);

			$this->set('rcps', $rcps);
			$this->set('pending', $pending);
			$this->set('approved', $approved);
			$this->set('declined', $declined);
		}

		public function create() {
			$response = $this->Notification->sendNotification();
			$return["allresponses"] = $response;
			$return = json_encode($return);

			$data = json_decode($response, true);

			$id = $data['id'];

			// debug($data);
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
		}

		public function approvers() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$approverId = $this->Approver->find('first', array(
					'joins' => array(
						array(
							'alias' => 'User',
							'table' => 'users',
							'type' => 'INNER',
							'conditions' => array(
								'User.id = Approver.app_id'
							)
						),
						array(
							'alias' => 'UserType',
							'table' => 'user_types',
							'type' => 'INNER',
							'conditions' => array(
								'UserType.id = User.type_id'
							)
						)
					),
					'conditions' => array(
						'Approver.dept_id' => $this->request->data['id']
					),
					'fields' => array(
						'User.firstname',
						'User.lastname',
						'User.id',
						'UserType.name'
					)
				));
				$altApproverId = $this->Approver->find('first', array(
					'joins' => array(
						array(
							'alias' => 'User',
							'table' => 'users',
							'type' => 'INNER',
							'conditions' => array(
								'User.id = Approver.alt_app_id'
							)
						),
						array(
							'alias' => 'UserType',
							'table' => 'user_types',
							'type' => 'INNER',
							'conditions' => array(
								'UserType.id = User.type_id'
							)
						)
					),
					'conditions' => array(
						'Approver.dept_id' => $this->request->data['id']
					),
					'fields' => array(
						'User.firstname',
						'User.lastname',
						'User.id',
						'UserType.name'
					)
				));
				$secondaryId = $this->Approver->find('first', array(
					'joins' => array(
						array(
							'alias' => 'User',
							'table' => 'users',
							'type' => 'INNER',
							'conditions' => array(
								'User.id = Approver.sec_id'
							)
						),
						array(
							'alias' => 'UserType',
							'table' => 'user_types',
							'type' => 'INNER',
							'conditions' => array(
								'UserType.id = User.type_id'
							)
						)
					),
					'conditions' => array(
						'Approver.dept_id' => $this->request->data['id']
					),
					'fields' => array(
						'User.firstname',
						'User.lastname',
						'User.id',
						'UserType.name'
					)
				));
				$altSecondaryId = $this->Approver->find('first', array(
					'joins' => array(
						array(
							'alias' => 'User',
							'table' => 'users',
							'type' => 'INNER',
							'conditions' => array(
								'User.id = Approver.alt_sec_id'
							)
						),
						array(
							'alias' => 'UserType',
							'table' => 'user_types',
							'type' => 'INNER',
							'conditions' => array(
								'UserType.id = User.type_id'
							)
						)
					),
					'conditions' => array(
						'Approver.dept_id' => $this->request->data['id']
					),
					'fields' => array(
						'User.firstname',
						'User.lastname',
						'User.id',
						'UserType.name'
					)
				));
				$response = array();

				if ($approverId) {
					$name = $approverId['User']['lastname'] . ", " . $approverId['User']['firstname'];
					$type = $approverId['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $approverId['User']['id']
					);

					$response['primary_app'] = $approver;
				}
				else {
					$approver = array(
						'approver' =>  Output::message('noApprover'),
						'id' => 0
					);

					$response['primary_app'] = $approver;
				}

				if ($altApproverId) {
					$name = $altApproverId['User']['lastname'] . ", " . $altApproverId['User']['firstname'];
					$type = $altApproverId['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $altApproverId['User']['id']
					);

					$response['alt_primary_app'] = $approver;
				}
				else {
					$approver = array(
						'approver' =>  Output::message('noAltApprover'),
						'id' => 0
					);

					$response['alt_primary_app'] = $approver;
				}

				if ($secondaryId) {
					$name = $secondaryId['User']['lastname'] . ", " . $secondaryId['User']['firstname'];
					$type = $secondaryId['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $secondaryId['User']['id']
					);

					$response['secondary_app'] = $approver;
				}
				else {
					$approver = array(
						'approver' =>  Output::message('noSecondary'),
						'id' => 0
					);

					$response['secondary_app'] = $approver;
				}

				if ($altSecondaryId) {
					$name = $altSecondaryId['User']['lastname'] . ", " . $altSecondaryId['User']['firstname'];
					$type = $altSecondaryId['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $altSecondaryId['User']['id']
					);

					$response['alt_secondary_app'] = $approver;
				}
				else {
					$approver = array(
						'approver' =>  Output::message('noAltSecondary'),
						'id' => 0
					);

					$response['alt_secondary_app'] = $approver;
				}
			}

			return Output::response($response);
		}

		public function sendRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$hasEmpty = Validate::rcpEmptyField($this->request->data);
				$isRushEmpty = Validate::rushHasBeenFilled($this->request->data);
				$isRush = Validate::isRush($this->request->data);

				if ($hasEmpty) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				elseif ($isRushEmpty) {
					$message = Output::message('rush');
					$response = Output::failed($message);
				}
				else {
					$this->Rcp->create();

					$data['rcp_no'] = $this->rcpNo($this->request->data['department']);
					$data['req_id'] = $this->Auth->user('id');
					$data['app_id'] = $this->request->data['approver'];
					$data['comp_id'] = $this->request->data['company'];
					$data['dept_id'] = $this->request->data['department'];
					$data['proj_id'] = $this->request->data['project'];
					$data['payee'] = $this->request->data['payee'];
					$data['issued_on'] = date('Y-m-d');
					$data['amount'] = $this->request->data['amount'];
					$data['amount_in_words'] = $this->request->data['amountInWords'];
					$data['expense_type'] = $this->request->data['expenseType'];

					if ($isRush) {
						$data['is_rush'] = 1;
					}
					else {
						$data['is_rush'] = 0;
					}

					$data['is_vatable'] = 0;
					$data['is_edited'] = 0;
					$data['created'] = date('Y-m-d H:i:s');
					$data['status_id'] = 1;

					$this->Rcp->set($data);

					$result = $this->Rcp->save();

					if ($result) {
						$message = Output::message('rcp');
						$response = Output::success($message);

						if ($isRush) {
							$this->RcpRush->create();

							$data['rcp_id'] = $result['Rcp']['id'];
							$data['due_date'] = date('Y-m-d', strtotime($this->request->data['dueDate']));
							$data['justification'] = $this->request->data['justification'];
							$data['created'] = date('Y-m-d H:i:s');

							$this->RcpRush->set($data);

							$this->RcpRush->save();
						}

						$qty = explode(",", $this->request->data['qty']);
						$unit = explode(",", $this->request->data['unit']);
						$particulars = explode(",", $this->request->data['particulars']);
						$refCode = explode(",", $this->request->data['refCode']);
						$amount = explode(",", $this->request->data['amount']);

						if (!empty($this->request->data['code'])) {
							$code = explode(",", $this->request->data['code']);
						}

						foreach ($particulars as $key => $value) {
							$this->RcpParticular->create();

							if (!empty($this->request->data['code'])) {
								$data['code'] = $code[$key];
							}

							$data['rcp_id'] = $result['Rcp']['id'];
							$data['qty'] = $qty[$key];
							$data['unit'] = $unit[$key];
							$data['particulars'] = $value;
							$data['ref_code'] = $refCode[$key];
							$data['amount'] = $amount[$key];
							$data['created'] = date('Y-m-d H:i:s');

							$this->RcpParticular->set($data);

							$this->RcpParticular->save();
						}

						$this->sendEmail(
							$result['Rcp']['id'],
							$this->Auth->user('id')
						);
					}
					else {
						$message = Output::message('error');
						$response = Output::failed($message);
					}
				}

				$response['rcp_no'] = $this->rcpNo($this->request->data['department']);
			}

			return Output::response($response);
		}

		public function rcpNo($id = null) {
			if ($id) {
				$departmentCode = $this->Department->find('first', array(
					'conditions' => array(
						'Department.id' => $id
					),
					'fields' => array(
						'Department.code'
					)
				));
				$totalRcp = $this->Rcp->find('count', array(
					'conditions' => array(
						'Rcp.dept_id' => $id
					)
				));
				$rcpNo = $departmentCode['Department']['code'] . ' ' . substr(date('y'), -2) . '-' . str_pad(($totalRcp + 1), 4, '0', STR_PAD_LEFT);

				return $rcpNo;
			}
		}

		public function details($id = null) {
			$details = $this->Rcp->details($id, $this->Auth->user('id'));
			$particulars = $this->Rcp->particulars($id, $this->Auth->user('id'));

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
		}

		public function edit($id = null) {
			$details = $this->Rcp->details($id, $this->Auth->user('id'));
			$particulars = $this->Rcp->particulars($id, $this->Auth->user('id'));
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
		}

		public function sendEmail($id = null, $userId = null) {
			$detail = $this->Rcp->details($id, $userId);

			$rcpNo = $detail['Rcp']['rcp_no'];
			$approverName = $detail['User']['firstname'] . ' ' . $detail['User']['lastname'];
			$department = $detail['Department']['name'];
			$company = $detail['Company']['name'];
			$project = $detail['Project']['name'];
			$payee = $detail['Rcp']['payee'];
			$issued = CakeTime::nice($detail['Rcp']['created']);

			$email = new CakeEmail();
			$email->config('smtp');

			$email->template('send_email')
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to('jiezzing@gmail.com')
			->subject('Request for Approval')
			->viewVars(array(
				'rcp_no' => $rcpNo,
				'app_name' => $approverName,
				'department' => $department,
				'company' => $company,
				'project' => $project,
				'payee' => $payee,
				'date' => $issued
			))
			->send();
		}
	}
