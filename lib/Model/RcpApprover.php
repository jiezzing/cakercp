<?php

    App::uses('AppModel', 'Model');

    class RcpApprover extends AppModel {

        public $usesTable = 'rcp_approvers';

		public function newApprover($rcpId = null, $appId = null) {
			$this->create();

			$data['rcp_id'] = $rcpId;
			$data['app_id'] = $appId;
			$data['created'] = date('Y-m-d H:i:s');
			$data['status_id'] = 1;

			$this->set($data);

			$this->save();
		}
    }
