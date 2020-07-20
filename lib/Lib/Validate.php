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
				if (empty($value) && ($key != 'dueDate' && $key != 'justification')) {
					return true;
				}
			}
        }

		public static function rushHasBeenFilled($data = array()) {
			if (!empty($data['dueDate']) && empty($data['justification'])) {
				return true;
			}
			else {
				if (empty($data['dueDate']) && !empty($data['justification'])) {
					return true;
				}
			}
		}

		public static function isRush($data = array()) {
            if (!empty($data['dueDate']) && !empty($data['justification'])) {
				return true;
			}
        }
	}
