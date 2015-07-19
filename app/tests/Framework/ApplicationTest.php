<?php

use App\Framework\Application;


class ApplicationTest extends TestCase {


	function testCanCreateApplication() {

		$app = new Application();
		$this->assertNotNull($app);

	}


	function testCanRunApplication() {

		$app = new Application();
		$response = $app->run();
		$this->assertNotNull($response);

	}


	function testApplicationReturnsResponse () {

		$app = new Application();
		$response = $app->run();
		$this->assertInstanceOf('App\Framework\Contracts\Response', $response);

	}


}
