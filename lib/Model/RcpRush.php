<?php

    App::uses('AppModel', 'Model');

    class RcpRush extends AppModel {

		public $usesTable = 'rcp_rushes';

		public function store($data = array()) {
			$rcp = array();

			$this->create();

			$rcp['rcp_id'] = $data['rcp_id'];
			$rcp['due_date'] = date('Y-m-d', strtotime($data['dueDate']));
			$rcp['justification'] = $data['justification'];
			$rcp['created'] = date('Y-m-d H:i:s');

			$this->set($rcp);

			$this->save();
		}
    }
