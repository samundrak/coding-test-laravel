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

}
