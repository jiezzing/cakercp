<?php

	class RCPController extends AppController {

		public $uses = array(
			'Company',
			'Project',
			'Department',
			'Approver',
			'Rcp',
			'RcpParticular',
			'RcpRush',
			'User',
			'UserAccount',
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
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
		}

		public function sendRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$rcpHasEmptyFields = Validate::rcpHasEmptyFields($this->request->data);
				$hasNoApprover = Validate::hasNoApprover($this->request->data);
				$hasRushEmptyField = Validate::hasRushEmptyField($this->request->data);
				$isRush = Validate::isRush($this->request->data);
				$rcpParticularsIsEmpty = Validate::rcpParticularsIsEmpty($this->request->data);

				if ($rcpHasEmptyFields) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				elseif ($rcpParticularsIsEmpty) {
					$message = Output::message('particularsEmpty');
					$response = Output::failed($message);
				}
				elseif ($hasNoApprover) {
					$message = Output::message('approver');
					$response = Output::failed($message);
				}
				elseif ($hasRushEmptyField) {
					$message = Output::message('rush');
					$response = Output::failed($message);
				}
				else {
					$result = $this->createRcp($this->request->data, $isRush);

					if ($result) {
						$rcpId = $result['Rcp']['id'];

						$message = Output::message('rcp');
						$response = Output::success($message);

						$this->createRcpParticulars($rcpId, $this->request->data);

						$subject = "Request for Approval";

						if ($isRush) {
							$this->createRushRcp($rcpId, $this->request->data);
							$subject = "RUSH Request for Approval";
						}

						$link = $this->request->data['origin'] . '' . $this->params->webroot . 'details/' . $rcpId;

						$this->sendEmail(
							$rcpId,
							$subject,
							$link
						);

						$playerId = $this->UserAccount->find('first', array(
							'conditions' => array(
								'UserAccount.user_id' => $this->request->data['approver']
							),
							'fields' => array(
								'UserAccount.player_id'
							)
						));

						if ($playerId) {
							$pushData = array();

							$pushData['content'] = "You have received a new Request for Check Payment.";
							$pushData['heading'] = $this->rcpNo($this->request->data['department']);
							$pushData['button_text'] = "See details";
							$pushData['url'] = $link;
							$pushData['player_id'] = $playerId['UserAccount']['player_id'];

							$pushNotification = $this->Notification->sendNotification($pushData);
						}
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

		public function details($id = null) {
			$details = $this->Rcp->details($id, $this->Auth->user('id'));
			$particulars = $this->Rcp->particulars($id, $this->Auth->user('id'));
			$rush = $this->Rcp->rush($id, $this->Auth->user('id'));

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('rush', $rush);
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

		public function createRcp($data = array(), $isRush = false) {
			$rcp = array();

			$this->Rcp->create();

			$rcp['rcp_no'] = $this->rcpNo($data['department']);
			$rcp['req_id'] = $this->Auth->user('id');
			$rcp['app_id'] = $data['approver'];
			$rcp['comp_id'] = $data['company'];
			$rcp['dept_id'] = $data['department'];
			$rcp['proj_id'] = $data['project'];
			$rcp['payee'] = $data['payee'];
			$rcp['issued_on'] = date('Y-m-d');
			$rcp['amount'] = preg_replace('/[^\d.]/', '', $data['totalAmount']);
			$rcp['amount_in_words'] = $data['amountInWords'];
			$rcp['expense_type'] = $data['expenseType'];

			$isRush ? $rcp['is_rush'] = 1 : $rcp['is_rush'] = 0;

			$rcp['is_vatable'] = 0;
			$rcp['is_edited'] = 0;
			$rcp['created'] = date('Y-m-d H:i:s');
			$rcp['status_id'] = 1;

			$this->Rcp->set($rcp);

			$result = $this->Rcp->save();

			return $result;
		}

		public function createRcpParticulars($id = null, $data = array()) {
			$rcp = array();

			if (!empty($data['code'])) {
				$code = explode(",", $this->request->data['code']);
			}

			$qty = explode(",", $data['qty']);
			$unit = explode(",", $data['unit']);
			$particulars = explode(",", $data['particulars']);
			$refCode = explode(",", $data['refCode']);
			$amount = explode(",", $data['amount']);

			foreach ($particulars as $key => $value) {
				$this->RcpParticular->create();

				if (!empty($data['code'])) {
					$rcp['code'] = $code[$key];
				}

				$rcp['rcp_id'] = $id;
				$rcp['qty'] = $qty[$key];
				$rcp['unit'] = $unit[$key];
				$rcp['particulars'] = $value;
				$rcp['ref_code'] = $refCode[$key];
				$rcp['amount'] = $amount[$key];
				$rcp['created'] = date('Y-m-d H:i:s');

				$this->RcpParticular->set($rcp);

				$this->RcpParticular->save();
			}
		}

		public function createRushRcp($id = null, $data = array()) {
			$rcp = array();

			$this->RcpRush->create();

			$rcp['rcp_id'] = $id;
			$rcp['due_date'] = date('Y-m-d', strtotime($data['dueDate']));
			$rcp['justification'] = $data['justification'];
			$rcp['created'] = date('Y-m-d H:i:s');

			$this->RcpRush->set($rcp);

			$this->RcpRush->save();
		}

		public function sendEmail($id = null, $subject = null, $link = null) {
			$detail = $this->Rcp->details($id, $this->Auth->user('id'));

			$rcpNo = $detail['Rcp']['rcp_no'];
			$approverName = $detail['User']['firstname'] . ' ' . $detail['User']['lastname'];
			$department = $detail['Department']['name'];
			$company = $detail['Company']['name'];
			$project = $detail['Project']['name'];
			$payee = $detail['Rcp']['payee'];
			$issued = CakeTime::nice($detail['Rcp']['created']);
			$emailAddress = $detail['UserAccount']['email'];

			$rushDetails = $this->Rcp->rush($id, $this->Auth->user('id'));

			if ($rushDetails) {
				$dueDate = $rushDetails['RcpRush']['due_date'];
				$justification = $rushDetails['RcpRush']['justification'];
				$supportingFile = $rushDetails['RcpRush']['supporting_file'];
			}
			else {
				$dueDate = null;
				$justification = null;
				$supportingFile = null;
			}

			$requestDetail = $this->User->find('first', array(
				'conditions' => array(
					'User.id' => $this->Auth->user('id')
				),
				'fields' => array(
					'User.firstname',
					'User.lastname'
				)
			));

			$requestor = $requestDetail['User']['firstname'] . ' ' . $requestDetail['User']['lastname'];

			$email = new CakeEmail();
			$email->config('smtp');

			$email->template('send_email')
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to($emailAddress)
			->subject($subject)
			->viewVars(array(
				'rcp_no' => $rcpNo,
				'app_name' => $approverName,
				'department' => $department,
				'company' => $company,
				'project' => $project,
				'payee' => $payee,
				'date' => $issued,
				'requestor' => $requestor,
				'link' => $link,
				'due_date' => $dueDate,
				'justification' => $justification
			))
			->send();
		}

		public function approvers() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$response = array();
				$primaryApprover = $this->primaryApprover($this->request->data);
				$altPrimaryApprover = $this->altPrimaryApprover($this->request->data);
				$secondaryApprover = $this->secondaryApprover($this->request->data);
				$altSecondaryApprover = $this->altSecondaryApprover($this->request->data);

				if ($primaryApprover) {
					$name = $primaryApprover['User']['lastname'] . ", " . $primaryApprover['User']['firstname'];
					$type = $primaryApprover['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $primaryApprover['User']['id']
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

				if ($altPrimaryApprover) {
					$name = $altPrimaryApprover['User']['lastname'] . ", " . $altPrimaryApprover['User']['firstname'];
					$type = $altPrimaryApprover['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $altPrimaryApprover['User']['id']
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

				if ($secondaryApprover) {
					$name = $secondaryApprover['User']['lastname'] . ", " . $secondaryApprover['User']['firstname'];
					$type = $secondaryApprover['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $secondaryApprover['User']['id']
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

				if ($altSecondaryApprover) {
					$name = $altSecondaryApprover['User']['lastname'] . ", " . $altSecondaryApprover['User']['firstname'];
					$type = $altSecondaryApprover['UserType']['name'];

					$approver = array(
						'approver' =>  $name . " - " . $type,
						'id' => $altSecondaryApprover['User']['id']
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

		public function primaryApprover($data = array()) {
			$result = $this->Approver->find('first', array(
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
					'Approver.dept_id' => $data['id']
				),
				'fields' => array(
					'User.firstname',
					'User.lastname',
					'User.id',
					'UserType.name'
				)
			));

			return $result;
		}

		public function altPrimaryApprover($data = array()) {
			$result = $this->Approver->find('first', array(
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
					'Approver.dept_id' => $data['id']
				),
				'fields' => array(
					'User.firstname',
					'User.lastname',
					'User.id',
					'UserType.name'
				)
			));

			return $result;
		}

		public function secondaryApprover($data = array()) {
			$result = $this->Approver->find('first', array(
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
					'Approver.dept_id' => $data['id']
				),
				'fields' => array(
					'User.firstname',
					'User.lastname',
					'User.id',
					'UserType.name'
				)
			));

			return $result;
		}

		public function altSecondaryApprover($data = array()) {
			$result = $this->Approver->find('first', array(
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

			return $result;
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
	}
