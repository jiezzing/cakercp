<?php

    App::uses('AppModel', 'Model');

    class Notification extends AppModel {

        public $usesTable = 'notifications';

		public function sendNotification($data = array()) {
			$content      = array(
				"en" => $data['content']
			);

			$heading      = array(
				"en" => $data['heading']
			);

			$hashes_array = array();
			array_push($hashes_array, array(
				"id" => "close-button",
				"text" => $data['button_text'],
				"icon" => "https://innoland.com.ph/wp-content/uploads/2019/10/Innoland.png",
				"url" => $data['url']
			));

			$fields = array(
				'app_id' => "e986f8c5-25e9-4579-a96d-a611536dbbef",
				'include_player_ids' => array($data['player_id']),
				'data' => array(
					"foo" => "bar"
				),
				'contents' => $content,
				'headings' => $heading,
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
