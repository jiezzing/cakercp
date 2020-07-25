<?php

	class UsersController extends AppController {
		public $uses = array(
			'Company',
			'Department',
			'Project',
			'UserType'
		);

		public function beforeFilter() {
            parent::beforeFilter();
        }

		public function create() {
			$companies = $this->Company->all();
			$departments = $this->Department->all();
			$projects = $this->Project->all();
			$userTypes = $this->UserType->all();

			$this->set('companies', $companies);
			$this->set('departments', $departments);
			$this->set('projects', $projects);
			$this->set('userTypes', $userTypes);
		}


	}
