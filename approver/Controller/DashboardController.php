<?php

	class DashboardController extends AppController {

		public function index() {
			if (!$this->Auth->loggedIn()) {
                return $this->redirect(Redirect::login());
			}
		}
	}
