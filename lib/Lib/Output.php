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

        public static function success($message = null, $result = null) {
            $data = array(
                'status' => 1,
                'message' => $message,
                'type' => 'Success',
                'result' => $result
            );

            return $data;
        }

        public static function message($key = null) {
            $data = array(
                'register' => 'User has been successfully registered.',
				'failed' => 'An error has occured. Please try again',
				'emptyField' => 'Some fields are missing. Please fill the fields required.'
            );

            return $data[$key];
        }
	}
