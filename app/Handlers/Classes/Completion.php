<?php 
namespace App\Handlers\Classes;
use App\Handlers\Classes\Callback;

class Completion implements Callback{
	private $result;
	public function __construct($result){
		$this->result =  $result;
	}
	public function run($error,$response){
		if($error) return  $this->result = false;
		return $this->result = true;
	}
}
