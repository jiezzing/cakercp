<?php

	class ProjectsController extends AppController {

		public $uses = array(
			'Project'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$projects = $this->Project->find('all');

			$this->set('projects', $projects);
		}
	}
