<?php

use App\Framework\Response\Base as BaseResponse;


class BaseTest extends TestCase {


	function testCanCreateResponse() {

		$response = new BaseResponse();
		$this->assertNotNull($response);

	}


	function testCanSendResponse() {

		$response = new BaseResponse();
		$output = $response->send();
		$this->assertEquals('', $output);

	}


}
