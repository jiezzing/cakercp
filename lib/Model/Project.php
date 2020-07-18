<?php

    App::uses('AppModel', 'Model');

    class Project extends AppModel {

        public $usesTable = 'projects';

		public function all() {
			$projects = $this->find('all');

			return $projects;
		}
    }
