<?php namespace App\Framework;

use App\Framework\Contracts\Request as RequestContract;
use App\Framework\Contracts\Route as RouteContract;


class Route implements RouteContract {


	/**
	 * string $method
	 */
	protected $method = 'GET';


	/**
	 * array $path
	 */
	protected $path = NULL;


	/**
	 * array $config
	 */
	protected $config;


	/**
	 * Construct
	 *
	 * @return void
	 */
	public function __construct($method, $path, array $config) {

		$this->method = $method;

		$path = trim($path, '/');
		$path = explode('/', $path);
		$this->path = $path;

		$this->config = $config;

	}


	/**
	 * Check if this route matches the request route
	 *
	 * @param App\Framework\Contracts\Request $request
	 * @return bool
	 */
	public function matches(RequestContract $request) {

		// Route can't match if the methods are different,
		// return early.
		if ($request->method !== $this->method) {
			return false;
		}

		// Route can't match if the number of path segments
		// is different, return early.
		if (count($request->path) !== count($this->path)) {
			return false;
		}

		// Loop through the path segments and check if they
		// match (including variable segments which start
		// with a ':').
		for ($i = 0; $i < count($this->path); $i++) {

			$this_path = $this->path[$i];
			$request_path = $request->path[$i];

			// If this path segment is a variable (starts with
			// ':') then just assume that they match and continue.
			if (substr($this_path, 0, 1) === ':') {
				continue;
			}

			// If the path segments don't match at any point
			// then the route can't match at all, return early.
			if ($this_path !== $request_path) {
				return false;
			}

		}

		// Can't find any reason not to match the route with the
		// request.
		return true;

	}


	/**
	 * Fire the route, calling the controller method specified
	 * in the config.
	 *
	 * @param App\Framework\Contracts\Request $request
	 * @return void
	 */
	public function fire(RequestContract $request) {

		if (
			isset($this->config['controller']) &&
			isset($this->config['action'])
		) {

			$action = $this->config['action'];
			$controller = $this->config['controller'];

			$controller = new $controller($request);
			return $controller->$action();

		}

	}


}
