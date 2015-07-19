<?php namespace Tests\Framework;

use App\Framework\Application;
use Tests\TestCase;


class ApplicationTest extends TestCase {


	function testCanCreateApplication() {

		$app = new Application([]);
		$this->assertNotNull($app);

	}


	function testApplicationImplementsContract() {

		$app = new Application([]);
		$this->assertInstanceOf('App\Framework\Contracts\Application', $app);

	}


	function testApplicationReturnsResponse () {

		$app = new Application([]);
		$response = $app->run();
		$this->assertInstanceOf('App\Framework\Contracts\Response', $response);

	}


}
