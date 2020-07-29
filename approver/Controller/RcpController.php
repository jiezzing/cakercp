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
	}
