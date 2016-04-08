<?php
namespace App\Handlers\Classes;
interface Storage {
	public function init();
	public function read();
	public function write();
	public function delete();
	public function update();
	public function close();
	public function select($filter);
}
