<?php

    App::uses('AppModel', 'Model');

    class UserAccount extends AppModel {

        public $usesTable = 'user_accounts';

		public function loginByUsernameAndPassword($username = null, $password = null) {
			$result = $this->find('first', array(
					'joins' => array(
						array(
							'alias' => 'User',
							'table' => 'users',
							'type' => 'INNER',
							'conditions' => array(
								'User.id = UserAccount.user_id'
							)
						)
					),
					'conditions' => array(
						'UserAccount.username' => $username,
						'UserAccount.password' => $password
					),
					'fields' => array(
						'User.id',
						'User.type_id'
					)
			));

			return $result;
		}

		public function playerId($id = null) {
			$result = $this->find('first', array(
				'conditions' => array(
					'UserAccount.user_id' => $id
				),
				'fields' => array(
					'UserAccount.player_id'
				)
			));

			return $result;
		}
    }
