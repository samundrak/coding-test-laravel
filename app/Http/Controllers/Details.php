<?php

namespace App\Http\Controllers;

use App\Handlers\Classes\Platform;
use App\Handlers\Classes\Utils;
use Illuminate\Http\Request;
use Validator;

class Details extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
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
			return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));
		}
		$platform = new Platform();
		$storage = $platform
			->setStorageType('csv')
			->init()
			->getStorageInstance()
			->write();

		if ($storage->insert($request->all())) {
			return Utils::response(1, "Details has been inserted");
		}

		return Utils::response(0, 'Unable to insert the details');
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
