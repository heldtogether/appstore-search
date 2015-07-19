<?php namespace App\Framework;

use App\Framework\Contracts\Route as RouteContract;


class Route implements RouteContract {


	/**
	 * string $method
	 */
	protected $method = 'GET';


	/**
	 * array $path
	 */
	protected $path = [];


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

		$path = $path;
		$path = trim($path, '/');
		$path = explode('/', $path);
		$this->path = $path;

		$this->config = $config;

	}


}
