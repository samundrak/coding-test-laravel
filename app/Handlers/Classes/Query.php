<?php
namespace App\Handlers\Classes;

class Query {
	private $resource;
	private $resourceLink;
	private $data;
	private $fields;

	public function getFields() {
		return $this->fields;
	}

	public function setFields($fields) {
		$this->fields = $fields;
	}
	public function __construct($resource) {
		$this->data = array();
		$this->resourceLink = $resource;
	}

	public function connect() {
		if (file_exists($this->resourceLink)) {
			$this->resource = fopen($this->resourceLink, 'r');
			return true;
		}
		throw new Exception("Unable to locate Storage file", 1);
		return false;
	}

	public function fetch() {
		while (!feof($this->resource)) {
			$tempArr = fgetcsv($this->resource);
			if (is_array($tempArr)) {
				$this->data[] = $tempArr;
				unset($tempArr);
			}

		}
		return $this;
	}

	public function select($filter = null) {
		if ($filter != null) {
			array_unique($filter);
		}

		$tempArr = array();
		$index = 0;
		$fields = explode(',', $this->getFields());
		array_push($fields, 'id');
		foreach ($this->data as $data) {
			++$index;
			array_push($data, $index);
			$tempArr[] = array_combine($fields, $data);
		}
		$this->data = $tempArr;
		array_shift($this->data);
		$tempArr = [];

		// $filter = array('id' => '2');
		if ($filter != null) {
			foreach ($this->data as $key => $value) {
				$matchedValue = 0;
				foreach ($value as $child_key => $child_value) {
					foreach ($filter as $filter_key => $filter_value) {
						// error_log($child_key . ' - ' . $child_value);
						if ($filter_key == $child_key && $filter_value == $value[$child_key]) {
							// error_log("key matched " . $filter_key . " and  " . $child_key);
							// error_log("value matched " . $value[$child_key] . " and  " . $filter_value);
							// error_log("");
							$matchedValue++;
						}
					}
				}
				// error_log($matchedValue);
				if ($matchedValue >= sizeof($filter)) {
					array_push($tempArr, $value);
				}

			}
			$this->data = $tempArr;
		}
		unset($tempArr);
		return $this;
	}

	public function getRowCount() {
		return sizeof($this->data);
	}

	public function limit($limit = '') {
		if (empty($limit)) {
			return $this;
		}

		$limit = $limit > sizeof($this->data) ? sizeof($this->data) : $limit;
		$tempArr = [];
		for ($i = 0; $i < $limit; $i++) {
			$tempArr[] = $this->data[$i];
		}
		$this->data = $tempArr;
		unset($tempArr);
		return $this;
	}

	public function range($from = '', $to = '') {
		if (empty($from) && empty($to)) {
			return $this;
		}

		$tempArr = [];
		foreach ($this->data as $data) {
			if ($data['id'] >= $from && $data['id'] <= $to) {
				array_push($tempArr, $data);
			}
		}
		$this->data = $tempArr;
		unset($tempArr);
		return $this;
	}

	public function reverse($reverse = '') {
		if (!empty($reverse)) {
			array_reverse($this->data);
		}

		return $this;
	}

	public function get() {
		return $this->data;
	}

	public function finish() {
		fclose($this->resource);
	}

	public function getFirst() {
		return array_shift($this->data);
	}
}