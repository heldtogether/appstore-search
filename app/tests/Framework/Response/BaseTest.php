<?php

use App\Framework\Response\Base as BaseResponse;


class BaseTest extends TestCase {


	function testCanCreateResponse() {

		$response = new BaseResponse();
		$this->assertNotNull($response);

	}


}
