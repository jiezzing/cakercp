<?php

	App::uses('AppModel', 'Model');

    class Approver extends AppModel {

		public $usesTable = 'approvers';

		public function currentApprover($id = null) {
			return $this->find('first', array(
				'conditions' => array(
					'Approver.dept_id' => $id
				),
				'fields' => array(
					'Approver.app_id',
					'Approver.alt_app_id',
					'Approver.sec_id',
					'Approver.alt_sec_id'
				)
			));
		}

		public function primaryApprovers() {
			return $this->find('all', array(
				'fields' => array('Approver.app_id')
			));
		}

		public function alternatePrimaryApprovers() {
			return $this->find('all', array(
				'fields' => array('Approver.alt_app_id')
			));
		}

		public function secondaryApprovers() {
			return $this->find('all', array(
				'fields' => array('Approver.sec_id')
			));
		}

		public function alternateSecondaryApprovers() {
			return $this->find('all', array(
				'fields' => array('Approver.alt_sec_id')
			));
		}

		public function updateApprover($data = array()) {
			return $this->updateAll(array(
				'Approver.app_id' => $data['primary'],
				'Approver.alt_app_id' => $data['alternatePrimary'],
				'Approver.sec_id' => $data['secondary'],
				'Approver.alt_sec_id' => $data['alternateSecondary']
			), array('Approver.dept_id' => $data['id']));
		}
    }
