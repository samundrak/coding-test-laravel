<?php

namespace App\Http\Controllers;

use App\Handlers\Classes\Platform;
use App\Handlers\Classes\Utils;
use Illuminate\Http\Request;
use Validator;

class Details extends Controller {
	private $platform;
	private $storage;
	public function __construct() {
		$this->platform = new Platform();
		$this->storage = $this->platform
			->setStorageType('csv')
			->init()
			->getStorageInstance()
			->write();

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$query = $this->storage->getQuery()->fetch();
		$select = $query
			->select();
		$result = $select
			->range($request->get('from'), $request->get('to'))
			->limit($request->get('limit'))
			->reverse($request->get('reverse'))
			->get();
		if ($result != null) {
			return Utils::getInstance()->response(1, json_encode(['lists' => $result, 'last' => $select->getRowCount() + 1]));
		}
		return Utils::getInstance()->response(0, "No Details List found");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		//
		$rules = array(
			'email' => 'required|email',
			'name' => 'required',
			'gender' => 'required',
			'phone' => 'required',
			'country' => 'required',
			'dob' => 'required',
			'education' => 'required',
			'address' => 'required',
		);

		$validator = Validator::make($request->all(), $rules);
		if (!$validator->passes()) {
			return Utils::getInstance()->response(0, Utils::getFormatedErrorMessages($validator->messages()));
		}

		if ($this->storage->insert($request->all())) {
			return Utils::getInstance()->response(1, "Details has been inserted");
		}

		return Utils::getInstance()->response(0, 'Unable to insert the details');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		$query = $this->storage->getQuery()->fetch();
		// error_log($id . '');
		$result = $query->select(['id' => $id . ''])->getFirst();
		if ($result != null) {
			return Utils::getInstance()->response(1, json_encode($result));
		} else {
			return Utils::getInstance()->response(1, "No result found");
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
