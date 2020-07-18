<?php

    App::uses('AppModel', 'Model');

    class UserType extends AppModel {

        public $usesTable = 'user_types';

		public function all() {
			$userTypes = $this->find('all');

			return $userTypes;
		}
    }
