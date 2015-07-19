<?php

require_once '../autoload.php';

$routes = [
	new App\Framework\Route('GET', '/', [
		'controller' => 'App\Controllers\Site\Home',
		'action'     => 'index',
	]),
	new App\Framework\Route('POST', '/api/1/apps', [
		'controller' => 'App\Controllers\API\Apps',
		'action'     => 'store',
	]),
	new App\Framework\Route('DELETE', '/api/1/apps/:id', [
		'controller' => 'App\Controllers\API\Apps',
		'action'     => 'delete',
	]),
];

$app = new App\Framework\Application($routes);
$response = $app->run();
$response->send();
