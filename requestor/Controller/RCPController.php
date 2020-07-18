<?php

	class RCPController extends AppController {

		public $uses = array(
            'Company'
		);

		public function beforeFilter() {
            parent::beforeFilter();
        }

		public function create() {
			$companies = $this->Company->find('all', array(
				'fields' => array(
					'Company.id',
					'Company.code',
					'Company.name',
				)
			));
		}
	}
