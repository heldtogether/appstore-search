<?php namespace App\Controllers\Site;

use App\Framework\Contracts\Request;
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

		$view = new View('index');
		echo $view->render();

	}


}
