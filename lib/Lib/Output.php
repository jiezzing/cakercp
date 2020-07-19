<?php

	class Output {

		public static function response($data = array()) {
            return json_encode($data);
        }

        public static function failed($message = null) {
            $data = array(
                'status' => 0,
                'message' => $message,
                'type' => 'Error'
            );

            return $data;
        }

        public static function success($message = null, $result = null, $url = null) {
            $data = array(
                'status' => 1,
                'message' => $message,
                'type' => 'Success',
				'result' => $result,
				'url' => $url
            );

            return $data;
        }

        public static function message($key = null) {
            $data = array(
                'register' => 'User has been successfully registered.',
				'failed' => 'An error has occured. Please try again',
				'emptyField' => 'Some fields are missing. Please fill the fields required.',
				'credential' => 'Username and password must not be empty.',
				'invalidCredential' => 'Please check your username and password or contact the System Administrator.',
				'noApprover' => 'No primary approver',
				'noAltApprover' => 'No alternate primary approver',
				'noSecondary' => 'No secondary approver',
				'noAltSecondary' => 'No alternate secondary approver',
				'projectExpense' => 'PROJECT EXPENSE',
				'departmentExpense' => 'DEPARTMENT EXPENSE',
            );

            return $data[$key];
		}

		public static function loginRedirect() {
            $data = array(
                'url' => $this->params->base . '/dashboard'
            );

            return $data[$key];
        }
	}
