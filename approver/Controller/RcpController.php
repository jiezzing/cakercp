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

		public $joinCondition = null;

		public function beforeFilter() {
			parent::beforeFilter();

			$this->joinCondtion = array(
				'alias' => 'User',
				'table' => 'users',
				'type' => 'INNER',
				'conditions' => array(
					'User.id = Rcp.req_id'
				)
			);
		}

		// rcp index / dashboard
		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect(Redirect::login());
			}

			$condition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  [1, 6]
			);
			$rcps = $this->Rcp->details($condition, 'all', $this->joinCondtion);

			$this->set('rcps', $rcps);
		}

		public function details($id = null) {
			$condition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
				'Rcp.id' =>  $id
			);

			$details = $this->Rcp->details($condition, 'first', $this->joinCondtion);
			$particulars = $this->Rcp->rcpParticulars($id);
			$rush = $this->Rcp->rush($id);

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('rush', $rush);
		}

		// return rcp with feedback
		public function feedback() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$email = array();

				$email['id'] = $this->request->data['id'];
				$email['feedback'] = $this->request->data['feedback'];
				$email['subject'] = 'Request for Check Payment Feedback';
				$email['color'] = 'orange';

				$this->notifyRequestorViaEmail($email);

				$message = Output::message('feedback');
				$response = Output::success($message);
			}

			return Output::response($response);
		}

		// approve rcp
		public function approve() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$email = array();

				$department = $this->Rcp->find('first', array(
					'conditions' => array('Rcp.id' => $this->request->data['id']),
					'fields' => array('Rcp.dept_id')
				));
				$approver = $this->Approver->currentApprover($department['Rcp']['dept_id']);

				if ($this->Auth->user('type_id') == 3) {
					$type = "alt_app_id";
					$progress = "1/4";
				}
				elseif ($this->Auth->user('type_id') == 4) {
					$type = "sec_id";
					$progress = "2/4";
				}
				elseif ($this->Auth->user('type_id') == 5) {
					$type = "alt_sec_id";
					$progress = "3/4";
				}
				else {
					$progress = "Complete!";
				}

				$email['id'] = $this->request->data['id'];
				$email['feedback'] = $this->request->data['feedback'];
				$email['subject'] = "Request for Check Payment Approval";
				$email['color'] = 'green';
				$email['progress'] = $progress;

				if ($this->Auth->user('type_id') != 6) {
					$email['app_id'] = $approver['Approver'][$type];
					$conditions = array(
						'Rcp.status_id' => 6,
						'Rcp.app_id' => $approver['Approver'][$type]
					);

					$this->RcpApprover->newApprover($this->request->data['id'], $approver['Approver'][$type]);
					$this->notifyNextApproverViaEmail($email);
				}
				else {
					$conditions = array('Rcp.status_id' => 2);
				}

				$result = $this->Rcp->updateAll($conditions, array(
					'Rcp.id' => $this->request->data['id'])
				);

				if ($result) {

					$this->RcpApprover->updateAll(
						array('RcpApprover.status_id' => 2),
						array(
							'RcpApprover.rcp_id' => $this->request->data['id'],
							'RcpApprover.app_id' => $this->Auth->user('id')
						)
					);

					$this->notifyRequestorViaEmail($email);

					$message = Output::message('approve');
					$response = Output::success($message);
				}
				else {
					$message = Output::message('failed');
					$response = Output::error($message);
				}
			}

			return Output::response($response);
		}

		// decline rcp
		public function decline() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$result = $this->Rcp->updateAll(array(
						'Rcp.status_id' => 3
					),
					array(
						'Rcp.id' => $this->request->data['id']
					)
				);

				if ($result) {
					$email = array();

					$email['id'] = $this->request->data['id'];
					$email['feedback'] = $this->request->data['feedback'];
					$email['subject'] = "Declined Request for Check Payment";
					$email['color'] = 'red';

					$this->notifyRequestorViaEmail($email);

					$message = Output::message('decline');
					$response = Output::success($message);
				}
				else {
					$message = Output::message('failed');
					$response = Output::error($message);
				}
			}

			return Output::response($response);
		}

		// send an email to the requestor
		public function notifyRequestorViaEmail($data = array()) {
			$result = $this->Rcp->rcpDetails($data['id']);
			$requestor = $this->User->profile($result['Rcp']['req_id']);

			$requestorName = $result['User']['firstname'] . ' ' . $result['User']['lastname'];

			$email = new CakeEmail();
			$email->config('smtp');

			$email->template('email')
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to($requestor['UserAccount']['email'])
			->subject($data['subject'])
			->viewVars(array(
				'rcp_no' => $result['Rcp']['rcp_no'],
				'requestor' => $requestorName,
				'feedback' => $data['feedback'],
				'color' => $data['color'],
				'title' => $data['subject'],
				'progress' => $data['progress']
			))
			->send();
		}

		// send email to next approver
		public function notifyNextApproverViaEmail($data = array()) {
			$approver = $this->User->profile($data['app_id']);
			$details = $this->Rcp->rcpDetails($data['id']);
			$requestor = $this->User->profile($details['Rcp']['req_id']);
			$rushDetails = $this->Rcp->rush($data['id']);

			$requestorName = $requestor['User']['firstname'] . ' ' . $requestor['User']['lastname'];
			$recepientName = $approver['User']['firstname'] . ' ' . $approver['User']['lastname'];

			$email = new CakeEmail();
			$email->config('smtp');

			$email->template('approval')
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to($approver['UserAccount']['email'])
			->subject($data['subject'])
			->viewVars(array(
				'recepient' => $recepientName,
				'requestor' => $requestorName,
				'details' => $details,
				'rush' => $rushDetails,
				'progress' => $data['progress']
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
	}
