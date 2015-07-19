<?php namespace Tests\Framework\Request;

use App\Framework\Request\Base as BaseRequest;
use Tests\TestCase;


class BaseTest extends TestCase {


	function testCanCreateRequest() {

		$request = new BaseRequest();
		$this->assertNotNull($request);

	}


}
