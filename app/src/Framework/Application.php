<?php namespace App\Framework;

use App\Framework\Contracts\Application as ApplicationContract;
use App\Framework\Response;


class Application implements ApplicationContract {


	/**
	 * Run the Application
	 *
	 * @return void
	 */
	public function run() {

		return new Response();

	}


}
