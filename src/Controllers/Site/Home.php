<?php namespace App\Controllers\Site;

use App\Framework\View;


class Home {


	public function index() {

		$view = new View('index');
		echo $view->render();

	}


}
