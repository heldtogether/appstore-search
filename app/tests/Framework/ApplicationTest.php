<?php

use App\Framework\Application;


class ApplicationTest extends TestCase {


	function testCanCreateApplication() {

		$app = new Application();
		$this->assertNotNull($app);

	}


}
