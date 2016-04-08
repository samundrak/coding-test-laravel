<?php
namespace App\Handlers\Classes;

class Utils {
	private static $INSTANCE;

	private function __construct() {}
	public static function getInstance() {
		if (self::$INSTANCE == null) {
			self::$INSTANCE = new Utils();
		}
		return self::$INSTANCE;
	}
	public function response($type, $message = null, $data = null) {
		$arr = ["success" => $type];
		if ($data != null) {
			$arr['data'] = $data;
		}
		if ($message != null) {
			$arr['message'] = $type === 0 ? is_array($message) ? $message : [$message] : $message;
		}
		return $arr;
	}

	public function getFormatedErrorMessages($data) {
		try {
			$data = json_decode($data, true);
			$messages = [];
			foreach ($data as $key => $value) {
				foreach ($value as $key => $value) {
					$messages[] = $value;
				}
			}
			return $messages;
		} catch (Exception $e) {
			return ["Server Error please try later"];
		}
	}

	public function getFields() {
		return "name,gender,phone,email,address,country,dob,education,contact";
	}
}
