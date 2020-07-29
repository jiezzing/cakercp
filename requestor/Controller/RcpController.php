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
			'UserAccount',
			'Notification',
			'RcpApprover'
		);

		public function beforeFilter() {
            parent::beforeFilter();
		}

		// rcp index / dashboard
		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$allRcpCondition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  [1, 2, 3]
			);
			$pendingCondition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  1
			);
			$approvedCondition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  2
			);
			$declinedCondition = array(
				'Rcp.req_id' => $this->Auth->user('id'),
				'Rcp.status_id' => 3
			);

			$rcps = $this->Rcp->allRcp($allRcpCondition);
			$pending = $this->Rcp->allRcp($pendingCondition);
			$approved = $this->Rcp->allRcp($approvedCondition);
			$declined = $this->Rcp->allRcp($declinedCondition);

			$this->set('rcps', $rcps);
			$this->set('pending', $pending);
			$this->set('approved', $approved);
			$this->set('declined', $declined);
		}

		// display the creat rcp page
		public function create() {
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
		}

		// creates rcp, particulars, rush rcp, send push notification and email to approver when sending rcp
		public function sendRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$createRcpHasEmptyFields = Validate::createRcpHasEmptyFields($this->request->data);
				$hasRushEmptyField = Validate::hasRushEmptyField($this->request->data);
				$isRush = Validate::isRush($this->request->data);
				$rcpParticularsIsEmpty = Validate::rcpParticularsIsEmpty($this->request->data);

				if ($createRcpHasEmptyFields) {
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
					$rcpNo = $this->rcpNo($this->request->data['department']);
					$result = $this->createRcp($this->request->data, $isRush);

					if ($result) {
						$approver = $this->Approver->currentApprover($this->request->data['department']);
						$rcpId = $result['Rcp']['id'];
						$link = $this->request->data['origin'] . '' . $this->params->webroot . 'details/' . $rcpId;
						$subject = "Request for Approval";

						$this->createRcpParticulars($rcpId, $this->request->data);

						if ($isRush) {
							$this->createRushRcp($rcpId, $this->request->data);
							$subject = "RUSH Request for Approval";
						}

						$this->sendEmail($rcpId, $subject, $link);
						$this->approver($rcpId, $approver['Approver']['app_id']);

						$playerId = $this->UserAccount->playerId($approver['Approver']['app_id']);

						if ($playerId) {
							$pushData = array();

							$pushData['content'] = "You have received RCP No: " . $rcpNo;
							$pushData['heading'] = "RCP Notification";
							$pushData['button_text'] = "See details";
							$pushData['url'] = $link;
							$pushData['player_id'] = $playerId['UserAccount']['player_id'];

							$pushNotification = $this->Notification->sendNotification($pushData);
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

		// shows the rcp details
		public function details($id = null) {
			$details = $this->Rcp->rcpDetails($id);
			$particulars = $this->Rcp->rcpParticulars($id);
			$rush = $this->Rcp->rcpRush($id);

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('rush', $rush);
		}

		// edit rcp
		public function edit($id = null) {
			$details = $this->Rcp->details($id, $this->Auth->user('id'));
			$particulars = $this->Rcp->particulars($id, $this->Auth->user('id'));
			$companies = $this->Company->find('all');
			$departments = $this->Department->find('all');
			$projects = $this->Project->find('all');
			$rush = $this->Rcp->rush($id, $this->Auth->user('id'));

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
			$this->set('rush', $rush);
			$this->render('edit');
		}

		// create new rcp
		public function createRcp($data = array(), $isRush = false) {
			$rcp = array();
			$approver = $this->Approver->currentApprover($data['department']);

			$this->Rcp->create();

			$rcp['rcp_no'] = $this->rcpNo($data['department']);
			$rcp['req_id'] = $this->Auth->user('id');
			$rcp['app_id'] = $approver['Approver']['app_id'];
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

		// stores list of particulars
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

		// store data if rcp is rush
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

		// send an email to the approver
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

		// stores data of is the approver of the rcp
		public function approver($id = null, $appId = null) {
			$data = array();

			$this->RcpApprover->create();

			$data['rcp_id'] = $id;
			$data['app_id'] = $appId;
			$data['created'] = date('Y-m-d H:i:s');
			$data['status_id'] = 1;

			$this->RcpApprover->set($data);

			$this->RcpApprover->save();
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
	}
