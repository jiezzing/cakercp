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
                return $this->redirect(Redirect::login());
			}

			$allRcpCondition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  [1, 2, 3]
			);
			$pendingCondition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  1
			);
			$approvedCondition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
				'Rcp.status_id' =>  2
			);
			$declinedCondition = array(
				'Rcp.app_id' => $this->Auth->user('id'),
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

		public function details($id = null) {
			$details = $this->Rcp->rcpDetails($id);
			$particulars = $this->Rcp->rcpParticulars($id);
			$rush = $this->Rcp->rcpRush($id);

			$this->set('detail', $details);
			$this->set('particulars', $particulars);
			$this->set('rush', $rush);
		}

		// return rcp with feedback
		public function returnRcp() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$this->sendEmail(
					$this->request->data['id'],
					$this->request->data['feedback']
				);

				$message = Output::message('feedback');
				$response = Output::success($message);
			}

			return Output::response($response);
		}

		// approve rcp
		public function approve() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$this->sendEmail(
					$this->request->data['id'],
					$this->request->data['feedback']
				);

				$message = Output::message('feedback');
				$response = Output::success($message);
			}

			return Output::response($response);
		}

		// send an email to the requestor
		public function sendEmail($id = null, $feedback = null) {
			$result = $this->Rcp->find('first', array(
				'joins' => array(
					array(
						'alias' => 'UserAccount',
						'table' => 'user_accounts',
						'type' => 'INNER',
						'conditions' => array(
							'UserAccount.user_id = Rcp.req_id'
						)
					),
					array(
						'alias' => 'User',
						'table' => 'users',
						'type' => 'INNER',
						'conditions' => array(
							'User.id = Rcp.req_id'
						)
					)
				),
				'conditions' => array(
					'Rcp.id' => $id
				),
				'fields' => array(
					'Rcp.rcp_no',
					'UserAccount.email',
					'User.firstname',
					'User.lastname'
				)
			));


			$requestor = $result['User']['firstname'] . ' ' . $result['User']['lastname'];

			$email = new CakeEmail();
			$email->config('smtp');

			$email->template('feedback_email')
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to($result['UserAccount']['email'])
			->subject("Request for Check Payment Feedback")
			->viewVars(array(
				'rcp_no' => $result['Rcp']['rcp_no'],
				'requestor' => $requestor,
				'feedback' => $feedback
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
