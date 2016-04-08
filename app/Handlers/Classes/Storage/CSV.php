<?php
namespace App\Handlers\Classes\Storage;

use App\Handlers\Classes\Query;
use App\Handlers\Classes\Storage;
use App\Handlers\Classes\Utils;

class CSV implements Storage {
	private $fileName;
	private $file;

	public function __construct() {
		$this->fileName = 'storage/storage.csv';
		$this->fields = Utils::getInstance()->getFields();
	}

	public function init() {
		if (!file_exists($this->fileName)) {
			$file = fopen($this->fileName, 'w');
			fputcsv($file, explode(',', $this->fields));
			fclose($file);
		}
		return $this;
	}
	public function read() {
		$this->file = fopen($this->fileName, 'r');
		return $this;
	}
	public function write() {
		$this->file = fopen($this->fileName, 'a');
		return $this;
	}
	public function delete() {
		unlink($this->fileName);
	}

	public function insert($data) {
		$fields = explode(',', $this->fields);
		$insertReadyData = array();
		try {
			foreach ($fields as $field) {
				if ($field != 'contact') {
					$insertReadyData[] = $data[$field];
				} else {
					$insertReadyData[] = 'null';
				}

			}
			fputcsv($this->file, explode(',', implode(',', $insertReadyData)));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	public function update() {}

	public function close() {
		if ($this->file != null) {
			fclose($this->file);
		}

	}

	public function getQuery() {
		$query = new Query($this->fileName);
		if ($query->connect()) {
			$query->setFields(Utils::getInstance()->getFields());
			return $query;
		}
		return null;
	}
}