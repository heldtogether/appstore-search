<?php namespace Tests\Framework\Request;

use App\Framework\Request\Base as BaseRequest;
use Tests\TestCase;


class BaseTest extends TestCase {


	function testCanCreateRequest() {

		$request = new BaseRequest();
		$this->assertNotNull($request);

	}


	function testRequestHasHTTPMethodProperty() {

		$request = new BaseRequest();
		$method = $request->method;
		$this->assertEquals('GET', $method);

	}


	function testRequestParsesHTTPMethod() {

		$expected_method = 'POST';

		$server = [
			'REQUEST_METHOD' => $expected_method,
		];

		$request = new BaseRequest($server);
		$method = $request->method;
		$this->assertEquals($expected_method, $method);

	}


	function testRequestDoesntParseInvalidHTTPMethod() {

		$expected_method = 'GET';

		$server = [
			'REQUEST_METHOD' => 'INVALID',
		];

		$request = new BaseRequest($server);
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

		$request = new BaseRequest($server);
		$path = $request->path;
		$this->assertEquals($expected_path, $path);

	}


}
