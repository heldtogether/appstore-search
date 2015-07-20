<?php namespace Tests\Framework;

use App\Framework\Request;
use App\Framework\Route;
use Tests\TestCase;


class RouteTest extends TestCase {


	function testCanCreateRoute() {

		$route = new Route('GET', '/', []);
		$this->assertNotNull($route);

	}


	function testRouteImplementsContract() {

		$route = new Route('GET', '/', []);
		$this->assertInstanceOf('App\Framework\Contracts\Route', $route);

	}


	function testRouteDoesntMatchInvalidRequest() {

		$request = new Request([
			'REQUEST_METHOD' => 'POST',
			'PATH_INFO' => '/some/dir/path.php',
		]);

		$route = new Route('GET', '/', []);
		$compare = $route->matches($request);

		$this->assertFalse($compare);

	}


	function testRouteMatchesValidGetRequest() {

		$request = new Request([
			'REQUEST_METHOD' => 'GET',
			'PATH_INFO' => '/',
		]);

		$route = new Route('GET', '/', []);
		$compare = $route->matches($request);

		$this->assertTrue($compare);

	}


	function testRouteMatchesValidPostRequest() {

		$request = new Request([
			'REQUEST_METHOD' => 'POST',
			'PATH_INFO' => '/some/dir/path',
		]);

		$route = new Route('POST', '/some/dir/path/', []);
		$compare = $route->matches($request);

		$this->assertTrue($compare);

	}


	function testRouteFetchesDynamicURLSegments() {

		$request = new Request([
			'REQUEST_METHOD' => 'POST',
			'PATH_INFO' => '/static/1/static',
		]);

		$route = new Route('POST', '/static/:id/static/', []);
		$route->matches($request);

		$this->assertEquals($route->url_parameters, [1]);

	}


}
