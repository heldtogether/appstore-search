<?php namespace App\Framework\Contracts;


interface Route {


	public function matches(Request $request);


}
