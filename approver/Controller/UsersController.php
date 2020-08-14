<?php

	class UsersController extends AppController {
		public $uses = array(
			'User',
			'UserAccount'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect(Redirect::login());
            }
		}

		public function updatePlayerId() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$result = $this->UserAccount->updateAll(array(
						'UserAccount.player_id' => "'{$this->request->data['playerId']}'"
					), array(
						'UserAccount.user_id' => $this->request->data['id']
					)
				);

				if ($result) {
					$message = Output::message('onesignal');
					$response = Output::success($message);;
				}
				else {
					$message = Output::message('failed');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}

		public function profile($id = null) {
			$profile = $this->User->profile($this->Auth->user('id'));

			$this->set('profile', $profile);
		}

		public function logout() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$this->Auth->logout();

				$response = Output::success(null, null, Redirect::login());
			}

			return Output::response($response);
		}
	}
