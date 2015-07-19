<?php namespace App\Framework;

use App\Framework\Contracts\Request as RequestContract;


class Request implements RequestContract {


	/**
	 * string $method
	 */
	public $method = 'GET';


	/**
	 * array $path
	 */
	public $path = [];


	/**
	 * array $allowed_methods
	 */
	protected $allowed_methods = [
		'DELETE',
		'GET',
		'POST',
		'PUT',
	];


	/**
	 * Construct
	 */
	public function __construct($server = NULL) {

		if ($server === NULL) {
			$server = $_SERVER;
		}

		if (
			isset($server['REQUEST_METHOD']) &&
			in_array($server['REQUEST_METHOD'], $this->allowed_methods)
		) {
			$this->method = $server['REQUEST_METHOD'];
		}

		if (isset($server['PATH_INFO'])) {
			$path = $server['PATH_INFO'];
			$path = trim($path, '/');
			$path = explode('/', $path);
			$this->path = $path;
		}

	}


}
