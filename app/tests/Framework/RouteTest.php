<?php namespace Tests\Framework;

use App\Framework\Route;
use Tests\TestCase;


class RouteTest extends TestCase {


	function testCanCreateRoute() {

		$route = new Route([]);
		$this->assertNotNull($route);

	}


	function testRouterImplementsContract() {

		$route = new Route([]);
		$this->assertInstanceOf('App\Framework\Contracts\Route', $route);

	}


}
