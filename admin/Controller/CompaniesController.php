<?php

	class CompaniesController extends AppController {

		public $uses = array(
			'Company'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$companies = $this->Company->find('all');

			$this->set('companies', $companies);
		}
	}
