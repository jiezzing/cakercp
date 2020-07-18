<?php
	class Output {

		public static function response($data = array()) {
            return json_encode($data);
        }

        public static function error($message = null) {
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
                'successLogin' => 'Successfully logged in.',
                'errorLogin' => 'Invalid username or password. Please try again.',
                'registered' => 'Account has been successfully created.',
                'error' => 'An error occured upon processing your request. Please try again.',
                'emailExist' => 'Email address already exist. Please try again.',
                'message' => 'Request has been successfully created. Please reload the page to see the changes.',
                'nameExist' => 'Name already exist. Please try again.',
                'file' => 'Files has been successfully uploaded.',
                'update' => 'Successfully updated. Please reload the page to see the changes.',
                'noChanges' => 'No changes detected.',
                'delete' => 'Successfully deleted. Please reload the page to see the changes.',
                'uploadFail' => 'An error occured upon uploading file. Please try again.',
				'verifyPassword' => 'You can now update your current password.',
				'integrate' => 'You school has integrated the Grading System Feature. Please reload the page to see the changes.',
				'first' => 'First Grading Period has been enabled. Please reload the page to see the changes.',
				'second' => 'Second Grading Period has been enabled. Please reload the page to see the changes.',
				'third' => 'Third Grading Period has been enabled. Please reload the page to see the changes.',
				'fourth' => 'Fourth Grading Period has been enabled. Please reload the page to see the changes.',
				'periodDisabled' => 'Grading Period has been disabled. Please reload the page to see the changes.',
				'grade' => 'Grade has been successfully updated. Please reload the page to see the changes.'
            );

            return $data[$key];
        }
	}
