<?php namespace App\Controllers\Site;

use App\Framework\Contracts\Request;
use App\Framework\Response;
use App\Framework\View;


class Home {


	/**
	 * App\Framework\Contracts\Request $request
	 */
	protected $request;


	/**
	 * Construct
	 *
	 * @param App\Framework\Contracts\Request $request
	 * @return void
	 */
	public function __construct(Request $request) {

		$this->request = $request;

	}


	/**
	 * List all the Apps
	 *
	 * @return void
	 */
	public function index() {

		$view = new View('index', [
			'algolia_search_key' => getenv('ALGOLIA_SEARCH_API_KEY'),
		]);
		return new Response(200, $view->render());

	}


}
