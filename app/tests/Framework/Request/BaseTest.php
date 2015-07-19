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


}
