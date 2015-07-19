<?php namespace Tests\Framework;

use App\Framework\Router;
use Tests\TestCase;


class RouterTest extends TestCase {


	function testCanCreateRouter() {

		$router = new Router();
		$this->assertNotNull($router);

	}


	function testRouterImplementsContract() {

		$router = new Router();
		$this->assertInstanceOf('App\Framework\Contracts\Router', $router);

	}


}
