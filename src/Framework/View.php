<?php namespace App\Framework;


class View {


	/**
	 * @var string $file
	 */
	protected $file = null;


	/**
	 * @var array $data
	 */
	protected $data = [];


	/**
	 * Construct
	 *
	 * @param string $view_name
	 * @param array $data
	 * @return void
	 */
	public function __construct($view_name, array $data = []) {

		$this->file = $this->get_view_file_path($view_name);

		if(!empty($data)) {
			$this->set($data);
		}

	}


	/**
	 * Add a View variable
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set($key, $value = null) {

		if(is_array($key)) {

			foreach($key as $k => $v) {
				$this->data[$k] = $v;
			}

		} else {

			$this->data[$key] = $value;

		}

		return $this;

	}


	/**
	 * Bind a variable to a View
	 *
	 * Binding a variable allows you to update it at a
	 * later state. If an unknown variable is bound,
	 * it's value is set to null.
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function bind($key, &$value) {

		$this->data[$key] =& $value;

		return $this;

	}


	/**
	 * Return final View as string
	 *
	 * @return string
	 */
	public function render() {

		if(!file_exists($this->file)) {
			throw new Exception('View not found: '.$this->file);
		}

		extract([
			'view_data' => $this->data,
		], EXTR_OVERWRITE);

		ob_start();
		include $this->file;
		return ob_get_clean();

	}


	/**
	 * Return the path to view file
	 *
	 * @param string $view_name
	 * @return string
	 */
	protected function get_view_file_path($view_name) {

		$view_file = strtolower($view_name);
		$view_file = preg_replace('/[^a-z0-9-_\/\.]/', '', $view_file);
		$view_file = $view_file . '.php';

		if(substr($view_file, 0, 1) !== '/') {
			$view_file = __DIR__ . '/../Views/' . $view_file;
		}

		return $view_file;

	}


}
