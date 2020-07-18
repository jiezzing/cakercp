<?php

    App::uses('AppModel', 'Model');

    class Department extends AppModel {

        public $usesTable = 'departments';

		public function all() {
			$departments = $this->find('all');

			return $departments;
		}
    }
