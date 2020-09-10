<?php

	class Output {

		public static function response($data = array()) {
            return json_encode($data);
        }

        public static function failed($message = null) {
            return array(
                'status' => 0,
                'message' => $message,
                'type' => 'Error'
            );
        }

        public static function success($message = null, $result = null, $url = null) {
			return array(
                'status' => 1,
                'message' => $message,
                'type' => 'Success',
				'result' => $result,
				'url' => $url
            );
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
				'rcp' => 'Request for Check Payment has been successfully sent.',
				'rush' => 'It seems that this RCP is rushed. Please have your due date, justifcation and an attached file.',
				'particularsEmpty' => 'Qty, unit, particulars, BOM Ref / Acct Code, code and amount fields must not be empty. Make sure to fill at least one row to proceed.',
				'updated' => 'Your RCP has been successfully updated. Please reload the page to see the changes.',
				'feedback' => 'Feedback of RCP has been successfully sent.',
				'approve' => 'RCP has been successfully approved.',
				'decline' => 'RCP has been successfully declined.',
				'approverNotSet' => 'The system detected missing department approvers. Please contact the System Administrator about this concern.',
				'approverSet' => 'All approvers were validate in this department. You can proceed in creating RCP.',
			);

			return $data[$key];
		}
	}
