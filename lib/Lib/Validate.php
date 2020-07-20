<?php

	class Validate {

        public static function registerEmptyField($data = array()) {
            foreach ($data as $value) {
				if (empty($value) && ($key != 'email' && $key != 'middleInitial')) {
					return true;
				}
			}
		}

		public static function loginEmptyField($data = array()) {
            foreach ($data as $value) {
				if (empty($value)) {
					return true;
				}
			}
        }

		public static function rcpEmptyField($data = array()) {
            foreach ($data as $key => $value) {
				if (empty($value) && ($key != 'rushDate' && $key != 'justification')) {
					return true;
				}
			}
        }

		public static function isRushEmpty($data = array()) {
            foreach ($data as $key => $value) {
				if ($key == 'dueDate' || $key == 'justification') {
					if (empty($value)) {
						return true;
					}
				}
			}
		}

		public static function isRush($data = array()) {
            foreach ($data as $key => $value) {
				if ($key == 'dueDate' || $key == 'justification') {
					if (!empty($value)) {
						return true;
					}
				}
			}
        }
	}
