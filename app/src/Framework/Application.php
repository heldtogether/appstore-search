<?php namespace App\Framework;

use App\Framework\Contracts\Application as ApplicationContract;
use App\Framework\Response;
use App\Framework\Router;
use Dotenv\Dotenv;


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

		try {
			$dotenv = new Dotenv(__DIR__ . '/../../');
			$dotenv->load();
		} catch (\InvalidArgumentException $e) {
			// Fall through, assume that environment variables
			// are being set some other way...
		}

		$router = new Router($this->routes);

		$request = new Request();
		$response = $router->dispatch($request);

		if (!$response) {
			$response = new Response(404, 'Page not found.');
		}

		return $response;

	}


}
