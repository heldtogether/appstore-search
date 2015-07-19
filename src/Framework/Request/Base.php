<?php namespace App\Framework\Request;


class Base {


	/**
	 * string $method
	 */
	public $method = 'GET';


	/**
	 * Construct
	 */
	public function __construct($server = NULL) {

		if ($server === NULL) {
			$server = $_SERVER;
		}

		if (isset($server['REQUEST_METHOD'])) {
			$this->method = $server['REQUEST_METHOD'];
		}

	}


}
