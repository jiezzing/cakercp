<?php

	class Redirect {

        public static function login() {
            return "../login";
		}

		public static function dashboard($typeId = null) {
			$url = null;

			if ($typeId == 1) {
				$url = '/admin/dashboard';
			}
			else if ($typeId == 2) {
				$url = '/requestor/dashboard';
			}
			else {
				$url = '/approver/dashboard';
			}

            return $url;
		}
	}
