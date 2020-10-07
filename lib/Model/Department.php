<?php

    App::uses('AppModel', 'Model');

    class Department extends AppModel {

		public $usesTable = 'departments';

        public function register($data = array()) {
			$field = array();

			$this->create();

			$field['code'] = strtoupper($data['code']);
			$field['name'] = strtoupper($data['name']);
			$field['created'] = date('Y-m-d H:i:s');

			$this->set($field);

			return $this->save();
		}

		public function details($id = null) {
			return $this->find('first', array(
				'conditions' => array('Department.id' => $id),
				'fields' => array(
					'Department.code',
					'Department.name'
				)
			));
		}

		public function isExist($data = array()) {
			return $this->find('first', array(
				'conditions' => array(
					'or' => array(
						'Department.code' => $data['code'],
						'Department.name' => $data['name']
					)
				)
			));
		}
    }
