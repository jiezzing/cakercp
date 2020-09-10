<?php

    App::uses('AppModel', 'Model');

    class RcpVatable extends AppModel {

		public $usesTable = 'rcp_vatables';

		public function store($data = array()) {
			$vat = array();

			$this->create();

			$vat['rcp_id'] = $data['rcp_id'];
			$vat['vat_id'] = $data['vatType'];
			$vat['less_vat'] = preg_replace('/[^\d.]/', '', $data['lessVat']);
			$vat['net_vat'] = preg_replace('/[^\d.]/', '', $data['netVat']);
			$vat['discount'] = preg_replace('/[^\d.]/', '', $data['discount']);
			$vat['amount_due'] = preg_replace('/[^\d.]/', '', $data['vatAmount']);
			$vat['add_vat'] = preg_replace('/[^\d.]/', '', $data['vatAmount']);

			$this->set($vat);

			return $this->save();
		}

		public function details($id = null) {
			return $this->find('first', array(
				'joins' => array(
					array(
						'alias' => 'Vat',
						'table' => 'vats',
						'type' => 'INNER',
						'conditions' => array(
							'Vat.id = RcpVatable.vat_id'
						)
					)
				),
				'conditions' => array(
					'RcpVatable.rcp_id' => $id
				),
				'fields' => array(
					'RcpVatable.less_vat',
					'RcpVatable.net_vat',
					'RcpVatable.discount',
					'RcpVatable.amount_due',
					'RcpVatable.add_vat',
					'RcpVatable.vat_id',
					'Vat.name',
					'Vat.percentage'
				)
			));
		}
    }
