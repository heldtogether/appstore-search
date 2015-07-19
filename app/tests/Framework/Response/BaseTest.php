<?php

use App\Framework\Response\Base as BaseResponse;


class BaseTest extends TestCase {


	function testCanCreateResponse() {

		$response = new BaseResponse();
		$this->assertNotNull($response);

	}


	function testResponseImplementsContract() {

		$response = new BaseResponse();
		$this->assertInstanceOf('App\Framework\Contracts\Response', $response);

	}


	function testCanSendResponse() {

		$response = new BaseResponse();
		$output = $response->send();
		$this->assertEquals('', $output);

	}


}
