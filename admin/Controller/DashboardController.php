<?php

	class DashboardController extends AppController {

		public function beforeFilter() {
			parent::beforeFilter();
        }
		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->logoutRedirect);
            }
		}
	}
