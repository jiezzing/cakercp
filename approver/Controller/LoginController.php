<?php

	class LoginController extends AppController {

		public $uses = array('Company');

		public function index() {
			$currentYear = date('Y');

			$this->set('currentYear', $currentYear);
		}
	}
