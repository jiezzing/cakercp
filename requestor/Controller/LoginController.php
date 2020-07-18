<?php

	App::uses('Controller', 'Controller');

	class LoginController extends Controller {

		public function index() {
			$currentYear = date('Y');

			$this->set('currentYear', $currentYear);
		}
	}
