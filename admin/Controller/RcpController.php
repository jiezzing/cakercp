<?php

	class RcpController extends AppController {

		public $uses = array(
			'Rcp'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}
		}
	}
