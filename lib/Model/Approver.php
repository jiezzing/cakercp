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
    }
