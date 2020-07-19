<?php

	class RCPController extends AppController {

		public $uses = array(
			'Company',
			'Project',
			'Department',
			'Approver'
		);

		public function beforeFilter() {
            parent::beforeFilter();
		}

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}
		}

		public function create() {
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

		public function expenseType() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				if ($this->request->data['checked'] == 'true') {
					$message = Output::message('projectExpense');
				}
				else {
					$message = Output::message('departmentExpense');
				}

				$response = Output::success($message);
			}

			return Output::response($response);
		}
	}
