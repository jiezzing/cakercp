<?php

    App::uses('AppModel', 'Model');

    class Notification extends AppModel {

        public $usesTable = 'notifications';

		public function sendNotification() {
			$content      = array(
				"en" => 'Kenji batig nawng'
			);

			$hashes_array = array();
			array_push($hashes_array, array(
				"id" => "close-button",
				"text" => "Go Back",
				"icon" => "http://i.imgur.com/N8SN8ZS.png",
				"url" => "https://yoursite.com"
			));

			$fields = array(
				'app_id' => "e986f8c5-25e9-4579-a96d-a611536dbbef",
				'include_player_ids' => array("65642398-695c-4150-a12f-90ba18363cf5"),
				'data' => array(
					"foo" => "bar"
				),
				'contents' => $content,
				'web_buttons' => $hashes_array
			);

			$fields = json_encode($fields);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json; charset=utf-8',
				'Authorization: Basic YTliZTY1MWMtZDdiZi00ZDQ4LWFiY2EtNzhjZDk0NDBkNDUz'
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);

			return $response;
		}
    }
