<?php
namespace App\Handlers\Classes;

use App\Handlers\Classes\Storage\CSV;

class Platform {

	private $storage;
	private $type;

	public function __construct() {

	}
	public function setStorageType($type) {
		$this->type = $type;
		if ($type == 'csv') {
			$this->storage = new CSV();
		}
		return $this;
	}

	public function init() {
		$this->storage->init();
		return $this;
	}
	public function getStorageInstance() {
		return $this->storage;
	}

	public function getType() {
		return $this->type;
	}
}