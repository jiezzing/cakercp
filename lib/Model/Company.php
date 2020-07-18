<?php

	App::uses('AppModel', 'Model');

    class Company extends AppModel {

        public $usesTable = 'companies';

		public function all() {
			$companies = $this->find('all');

			return $companies;
		}
    }
