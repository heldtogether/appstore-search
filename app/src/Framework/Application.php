<?php namespace App\Framework;

use App\Framework\Contracts\Application as ApplicationContract;
use App\Framework\Response;
use App\Framework\Router;


class Application implements ApplicationContract {


	/**
	 * array $routes
	 */
	protected $routes;


	/**
	 * Construct
	 *
	 * @param array $routes
	 * @return void
	 */
	public function __construct(array $routes) {

		$this->routes = $routes;

	}


	/**
	 * Run the Application
	 *
	 * @return App\Framework\Contracts\Response
	 */
	public function run() {

		$router = new Router($this->routes);

		$request = new Request();
		$response = $router->dispatch($request);

		if (!$response) {
			$response = new Response();
		}

		return $response;

	}


}
