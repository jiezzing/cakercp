<?php

	class DepartmentsController extends AppController {

		public $uses = array(
			'Department'
		);

		public function beforeFilter() {
			parent::beforeFilter();
        }

		public function index() {
			if(!$this->Auth->loggedIn()) {
                return $this->redirect($this->Auth->loginRedirect);
			}

			$departments = $this->Department->find('all');

			$this->set('departments', $departments);
		}

		public function store() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$hasEmpty = Validate::hasEmpty($this->request->data);

				if ($hasEmpty) {
					$message = Output::message('emptyField');
					$response = Output::failed($message);
				}
				else {
					$exist = $this->Department->isExist($this->request->data);

					if ($exist) {
						$message = Output::message('exist');
						$response = Output::failed($message);
					}
					else {
						$result = $this->Department->register($this->request->data);

						if ($result) {
							$message = Output::message('register');
							$response = Output::success($message);
						}
						else {
							$message = Output::message('error');
							$response = Output::failed($message);
						}
					}
				}
			}

			return Output::response($response);
		}

		public function delete() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$result = $this->Department->delete($this->request->data['id']);

				if ($result) {
					$message = Output::message('delete');
					$response = Output::success($message);
				}
				else {
					$message = Output::failed('error');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}

		public function edit() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$result = $this->Department->details($this->request->data['id']);

				if ($result) {
					$response = Output::success(null, $result);
				}
				else {
					$message = Output::message('error');
					$response = Output::failed($message);
				}
			}

			return Output::response($response);
		}

		public function update() {
			$this->autoRender = false;

			if ($this->request->is('ajax')) {
				$exist = $this->Department->isExist($this->request->data);

				if ($exist) {
					$message = Output::message('exist');
					$response = Output::failed($message);
				}
				else {
					$result = $this->Department->updateAll(array(
							'Department.code' => $this->request->data['code'],
							'Department.name' => $this->request->data['name']
						), array(
							'Department.id' => $this->request->data['id']
						)
					);

					if ($result) {
						$message = Output::message('update');
						$response = Output::success($message);
					}
					else {
						$message = Output::message('error');
						$response = Output::failed($message);
					}
				}
			}

			return Output::response($response);
		}
	}
