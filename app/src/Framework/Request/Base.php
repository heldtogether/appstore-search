<?php namespace App\Framework\Request;


class Base {


	/**
	 * string $method
	 */
	public $method = 'GET';


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

	}


}
