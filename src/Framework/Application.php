<?php namespace App\Framework;

use App\Framework\Contracts\Application as ApplicationContract;
use App\Framework\Response;
use App\Framework\Router;


class Application implements ApplicationContract {


	/**
	 * Run the Application
	 *
	 * @return App\Framework\Contracts\Response
	 */
	public function run() {

		$router = new Router([]);

		$request = new Request;
		$reponse = $router->dispatch($request);

		return new Response();

	}


}
