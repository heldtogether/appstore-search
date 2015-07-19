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
	public $path = NULL;


	/**
	 * array $parameters
	 */
	public $parameters = [];


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

		$path = '/';
		if (isset($server['PATH_INFO'])) {
			$path = $server['PATH_INFO'];
		}

		$path = trim($path, '/');
		$path = explode('/', $path);
		$this->path = $path;

		$this->parseParameters();

	}


	/**
	 * Parse parameters
	 *
	 * @return void
	 */
	protected function parseParameters() {

		$parameters = array();

		if (isset($_SERVER['QUERY_STRING'])) {
			parse_str($_SERVER['QUERY_STRING'], $parameters);
		}

		$body = file_get_contents("php://input");

		$content_type = false;
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$content_type = $_SERVER['CONTENT_TYPE'];
		}

		switch($content_type) {

			case "application/json":
				$body_params = json_decode($body);
				if($body_params) {
					foreach($body_params as $param_name => $param_value) {
						$parameters[$param_name] = $param_value;
					}
				}
				break;

			case "application/x-www-form-urlencoded":
				parse_str($body, $postvars);
				foreach($postvars as $field => $value) {
					$parameters[$field] = $value;

				}
				break;

			default:
				break;

		}

		$this->parameters = $parameters;

	}


}
