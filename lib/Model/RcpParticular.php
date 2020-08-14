<?php

    App::uses('AppModel', 'Model');

    class RcpParticular extends AppModel {

			public $usesTable = 'rcp_particulars';

			public function store($data = array()) {
				$rcp = array();

				if (!empty($data['code'])) {
					$code = explode(",", $data['code']);
				}

				$qty = explode(",", $data['qty']);
				$unit = explode(",", $data['unit']);
				$particulars = explode(",", $data['particulars']);
				$refCode = explode(",", $data['refCode']);
				$amount = explode(",", $data['amount']);

				foreach ($particulars as $key => $value) {
					$this->create();

					if (!empty($data['code'])) {
						$rcp['code'] = $code[$key];
					}

					$rcp['rcp_id'] = $data['rcp_id'];
					$rcp['qty'] = $qty[$key];
					$rcp['unit'] = $unit[$key];
					$rcp['particulars'] = $value;
					$rcp['ref_code'] = $refCode[$key];
					$rcp['amount'] = $amount[$key];
					$rcp['created'] = date('Y-m-d H:i:s');

					$this->set($rcp);

					$this->save();
				}
			}

    }
