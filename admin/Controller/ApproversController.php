<?php

	class ApproversController extends AppController {

		public $uses = array(
			'Approver',
			'Department',
			'User'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$departments = $this->Department->find('all');
			$primaries = $this->Approver->primaryApprovers();
			$alternatePrimaries = $this->Approver->alternatePrimaryApprovers();
			$secondaries = $this->Approver->secondaryApprovers();
			$alternateSecondaries = $this->Approver->alternateSecondaryApprovers();
			$primaryApprovers = $this->approverNames($primaries, 'app_id');
			$alternatePrimaryApprovers = $this->approverNames($alternatePrimaries, 'alt_app_id');
			$secondaryApprovers = $this->approverNames($secondaries, 'sec_id');
			$alternateSecondaryApprovers = $this->approverNames($alternateSecondaries, 'alt_sec_id');

			$this->set('departments', $departments);
			$this->set('primaryApprovers', $primaryApprovers);
			$this->set('alternatePrimaryApprovers', $alternatePrimaryApprovers);
			$this->set('secondaryApprovers', $secondaryApprovers);
			$this->set('alternateSecondaryApprovers', $alternateSecondaryApprovers);
		}

		public function edit($id = null) {
			$departmentApprovers = $this->Approver->currentApprover($id);
			$primaryApprovers = $this->User->approvers(3);
			$alternatePrimaryApprovers = $this->User->approvers(4);
			$secondaryApprover = $this->User->approvers(5);
			$alternateSecondaryApprovers = $this->User->approvers(6);

			$this->set('departmentApprovers', $departmentApprovers);
			$this->set('primaryApprovers', $primaryApprovers);
			$this->set('alternatePrimaryApprovers', $alternatePrimaryApprovers);
			$this->set('secondaryApprover', $secondaryApprover);
			$this->set('alternateSecondaryApprovers', $alternateSecondaryApprovers);
		}

		public function updateApprover() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$updated = $this->Approver->updateApprover($this->request->data);

				if ($updated) {
					$message = Output::message('update');
					$response = Output::success($message);
				}
				else {
					$message = Output::message('failed');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}

		public function removeAllApprovers() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$data = array();
				$data['id'] = $this->request->data['id'];
				$data['primary'] = 0;
				$data['alternatePrimary'] = 0;
				$data['secondary'] = 0;
				$data['alternateSecondary'] = 0;

				$updated = $this->Approver->updateApprover($data);

				if ($updated) {
					$message = Output::message('removeAllApprover');
					$response = Output::success($message);
				}
				else {
					$message = Output::message('failed');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}

		public function approverNames($data = array(), $role = null) {
			$approvers = [];
			$result = null;

			foreach ($data as $value) {
				if (empty($value['Approver'][$role])) {
					$approvers[] = array(
						'firstname' => '---',
						'lastname' => '---'
					);
				}
				else {
					$result = $this->User->find('first', array(
						'conditions' => array(
							'User.id' => $value['Approver'][$role]
						),
						'fields' => array(
							'User.firstname',
							'User.lastname'
						)
					));

					$approvers[] = $result['User'];
				}
			}

			return $approvers;
		}
	}
