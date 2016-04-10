<?php

class ExampleTest extends TestCase {
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	public function testViews() {
		/*Testing root*/
		$this->visit('/')
			->see('add data');

		/*Testing Home views*/
		$this->visit('/views/partials/home')
			->see('contact');

		/*Testing List views*/
		$this->visit('/views/partials/list')
			->see('phone');

		/*Testing edit views*/
		$this->visit('/views/partials/edit')
			->see('gender');
	}

	public function testApis() {
		// $response = $this->call('GET', '/api/details/2');
		// echo $response->getContent();
		// $this->assertResponseStatus(200);

	}

	public function testControllers() {
		// $response = $response = $this->action('GET', 'Details@index');
		echo 1;
	}
}
