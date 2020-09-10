<?php

	class DashboardController extends AppController {

		public $uses = array(
			'Rcp'
		);

		public function index() {
			if (!$this->Auth->loggedIn()) {
                return $this->redirect(Redirect::login());
			}

			$condition = array(
				'Rcp.req_id' => $this->Auth->user('id')
			);
			$join = array(
				'alias' => 'User',
				'table' => 'users',
				'type' => 'INNER',
				'conditions' => array(
					'User.id = Rcp.app_id'
				)
			);

			$rcps = $this->Rcp->details($condition, 'all', $join);
			$tally = $this->Rcp->tally($this->Auth->user('id'));

			foreach ($rcps as $key => $data) {
				$data['Rcp']['expense_type'] == "DEPARTMENT EXPENSE" ? $rcps[$key]['Rcp']['total_progress'] = 4 : $rcps[$key]['Rcp']['total_progress'] = 2;
			}

			$this->set('rcps', $rcps);
			$this->set('tally', $tally);
		}
	}
