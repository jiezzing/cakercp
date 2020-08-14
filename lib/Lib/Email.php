<?php

	class Email {

        public static function send($data = array()) {
            $email = new CakeEmail();
			$email->config('smtp');

			$email->template($data['template'])
			->emailFormat('html')
			->from(array('no-reply@innoland.com' => 'System Administrator'))
			->to($data['recepient'])
			->subject($data['subject'])
			->viewVars($data['viewVars'])
			->send();
		}
	}
