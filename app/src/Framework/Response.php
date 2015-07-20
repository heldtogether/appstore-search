<?php namespace App\Framework;

use App\Framework\Contracts\Response as ResponseContract;


class Response implements ResponseContract {


	/**
	 * @var int $code
	 */
	protected $code = 200;


	/**
	 * @var string $body
	 */
	protected $body = '';


	/**
	 * @var string $content_type
	 */
	protected $content_type = 'text/html';


	/**
	 * Construct
	 *
	 * @param int $code
	 * @param string $body
	 * @param string $content_type
	 * @return void
	 */
	public function __construct(
		$code = NULL,
		$body = NULL,
		$content_type = NULL
	) {

		if ($code) {
			$this->code = $code;
		}

		if ($body) {
			$this->body = $body;
		}

		if ($content_type) {

			switch ($content_type) {
				case 'json':
					$this->content_type = 'application/json';
					break;

				default:
					break;
			}

		}

	}


	/**
	 * Send the response
	 *
	 * @return void
	 */
	public function send() {

		http_response_code($this->code);
		header('Content-Type: ' . $this->content_type);
		echo $this->body;

	}


}
