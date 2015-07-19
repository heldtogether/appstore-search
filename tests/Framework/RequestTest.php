<?php namespace Tests\Framework;

use App\Framework\Request;
use Tests\TestCase;


class RequestTest extends TestCase {


	function testCanCreateRequest() {

		$request = new Request();
		$this->assertNotNull($request);

	}


	function testRequestImplementsContract() {

		$request = new Request();
		$this->assertInstanceOf('App\Framework\Contracts\Request', $request);

	}


	function testRequestHasHTTPMethodProperty() {

		$request = new Request();
		$method = $request->method;
		$this->assertEquals('GET', $method);

	}


	function testRequestParsesHTTPMethod() {

		$expected_method = 'POST';

		$server = [
			'REQUEST_METHOD' => $expected_method,
		];

		$request = new Request($server);
		$method = $request->method;
		$this->assertEquals($expected_method, $method);

	}


	function testRequestDoesntParseInvalidHTTPMethod() {

		$expected_method = 'GET';

		$server = [
			'REQUEST_METHOD' => 'INVALID',
		];

		$request = new Request($server);
		$method = $request->method;
		$this->assertEquals($expected_method, $method);

	}


	function testRequestParsesPathInfo() {

		$expected_path = [
			'some',
			'dir',
			'path.php',
		];

		$server = [
			'PATH_INFO' => '/some/dir/path.php',
		];

		$request = new Request($server);
		$path = $request->path;
		$this->assertEquals($expected_path, $path);

	}


}
