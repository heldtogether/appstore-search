<?php namespace App\Framework;

use App\Framework\Contracts\Request as RequestContract;
use App\Framework\Contracts\Router as RouterContract;


class Router implements RouterContract {


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
	public function __construct(array $routes = []) {

		$this->routes = $routes;

	}


	/**
	 * Match the request to a route
	 *
	 * @param App\Framework\Contracts\Request $request
	 * @return void
	 */
	public function dispatch(RequestContract $request) {

		//

	}


}
