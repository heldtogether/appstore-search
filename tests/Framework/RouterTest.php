<?php namespace Tests\Framework;

use App\Framework\Request;
use App\Framework\Router;
use Mockery;
use Tests\TestCase;


class RouterTest extends TestCase {


	function testCanCreateRouter() {

		$router = new Router([]);
		$this->assertNotNull($router);

	}


	function testRouterImplementsContract() {

		$router = new Router([]);
		$this->assertInstanceOf('App\Framework\Contracts\Router', $router);

	}


	function testRouterFiresRouteIfMatches() {

		$request = new Request();

		$route = Mockery::mock('App\Framework\Contracts\Route');
		$route->shouldReceive('matches')->once()->andReturn(true);
		$route->shouldReceive('fire')->once();

		$routes = [
			$route,
		];

		$router = new Router($routes);
		$router->dispatch($request);

	}


	function testRouterShouldntFireRouteIfDoesntMatches() {

		$request = new Request();

		$route = Mockery::mock('App\Framework\Contracts\Route');
		$route->shouldReceive('matches')->once()->andReturn(false);
		$route->shouldReceive('fire')->never();

		$routes = [
			$route,
		];

		$router = new Router($routes);
		$router->dispatch($request);

	}


}
