<?php namespace App\Controllers\API;

use AlgoliaSearch\Client as SearchClient;
use App\Framework\Contracts\Request;


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

		foreach ($required_parameters as $parameter) {

			if (!isset($this->request->parameters[$parameter])) {
				// ERROR
			}

		}

		$result = $this->index->saveObject([
			'objectID' => $this->request->parameters['objectID'],
			'name'     => $this->request->parameters['name'],
			'image'    => $this->request->parameters['image'],
			'link'     => $this->request->parameters['link'],
			'category' => $this->request->parameters['category'],
			'rank'     => $this->request->parameters['rank'],
		]);

	}


	public function delete() {

		$id = $this->request->parameters['id'];
		$this->index->deleteObject($id);

	}


}
