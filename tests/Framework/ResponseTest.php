<?php namespace Tests\Framework;

use App\Framework\Response;
use Tests\TestCase;


class ResponseTest extends TestCase {


	function testCanCreateResponse() {

		$response = new Response();
		$this->assertNotNull($response);

	}


	function testResponseImplementsContract() {

		$response = new Response();
		$this->assertInstanceOf('App\Framework\Contracts\Response', $response);

	}


	function testCanSendResponse() {

		$response = new Response();
		$output = $response->send();
		$this->assertEquals('', $output);

	}


}
