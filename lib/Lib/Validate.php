<?php

	class Validate {

        public static function registerEmptyField($data = array()) {
            foreach ($data as $key => $value) {
				if (empty($value) && ($key != 'email' && $key != 'middleInitial')) {
					return true;
				}
			}
		}

		public static function loginEmptyField($data = array()) {
            foreach ($data as $key => $value) {
				if (empty($value)) {
					return true;
				}
			}
        }
	}
