<?php

	class Validate {

        public static function registerEmptyField($data = array()) {
            foreach ($data as $key => $value) {
				if (empty($value) && ($key != 'middleInitial')) {
					return true;
				}
			}
		}

		public static function login($data = array()) {
            foreach ($data as $value) {
				if (empty($value)) {
					return true;
				}
			}
        }

		public static function createRcpHasEmptyFields($data = array()) {
			if (empty($data['department']) || empty($data['project']) ||
			empty($data['company']) || empty($data['payee'])) {
				return true;
			}
        }

		public static function updateRcpHasEmptyFields($data = array()) {
			if (empty($data['project']) || empty($data['company']) || empty($data['payee'])) {
				return true;
			}
        }

		public static function hasRushEmptyField($data = array()) {
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

		public static function rcpParticularsIsEmpty($data = array()) {
            if (empty($data['qty'])) {
				return true;
			}
        }
	}
