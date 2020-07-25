<?php

	class DepartmentsController extends AppController {

		public $uses = array(
			'Department'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$departments = $this->Department->find('all');

			$this->set('departments', $departments);
		}
	}
