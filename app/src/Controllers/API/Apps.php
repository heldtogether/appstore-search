<?php namespace App\Controllers\API;

use AlgoliaSearch\Client as SearchClient;
use App\Framework\Contracts\Request;
use App\Framework\Response;


class Apps {


	/**
	 * App\Framework\Contracts\Request $request
	 */
	protected $request;


	/**
	 * AlgoliaSearch\Client $client
	 */
	protected $client;


	/**
	 * AlgoliaSearch\Index $index
	 */
	protected $index;


	/**
	 * Construct
	 *
	 * @param App\Framework\Contracts\Request $request
	 * @return void
	 */
	public function __construct(Request $request) {

		$this->request = $request;

		$this->client = new SearchClient(
			'889MEAME3D',
			'009f9f04d0a477f8006925c4f37b7647'
		);

		$this->index = $this->client->initIndex('Apps');

	}


	/**
	 * Store a new App in the search index
	 *
	 * @return void
	 */
	public function store() {

		$required_parameters = [
			'objectID',
			'name',
			'image',
			'link',
			'category',
			'rank',
		];

		$errors = [];

		foreach ($required_parameters as $parameter) {

			if (!isset($this->request->parameters[$parameter])) {
				$errors[$parameter] = 'The ' . $parameter . ' is required';
			}

		}

		if (!empty($errors)) {
			return new Response(
				422,
				json_encode(['errors' => $errors]),
				'json'
			);
		}

		$object = [
			'objectID' => $this->request->parameters['objectID'],
			'name'     => $this->request->parameters['name'],
			'image'    => $this->request->parameters['image'],
			'link'     => $this->request->parameters['link'],
			'category' => $this->request->parameters['category'],
			'rank'     => $this->request->parameters['rank'],
		];

		$result = $this->index->saveObject($object);

		if ($result) {

			return new Response(
				201,
				json_encode(['app' => $object]),
				'json'
			);

		} else {

			return new Response(
				500,
				json_encode(['error' => 'Unable to create new app.']),
				'json'
			);

		}

	}


	/**
	 * Delete an App from the search index
	 *
	 * @param int $id
	 * @return void
	 */
	public function delete($id) {

		$this->index->deleteObject($id);

		return new Response(
			204,
			NULL,
			'json'
		);

	}


}
