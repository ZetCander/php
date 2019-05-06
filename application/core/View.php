<?php

namespace application\core;

use application\controllers\errors\ErrorPage;

class View {
	
	public $path;
	public $layout = 'default';

	public function __construct($route) {
		$this->path = $route['controller'] . '/' . $route['action'];
	}

	public function render($title, $vars = []) {
		if (file_exists('application/views/' . $this->path . '.php')) {
			ob_start();
			require 'application/views/' . $this->path . '.php';
			$content = ob_get_clean();
			require 'application/views/layouts/' . $this->layout . '.php';
		}
		else {
			echo 'Вид не найден' . $this->path;
		}
	}

	public static function errorCode($code) {
		http_response_code($code);

		ErrorPage::printError($code);
		exit;
	}

	public static function message($message) {
		exit(json_encode(['message' => $message]));
	}

	public function setLayout($layout) {
		$this->layout = $layout;
	}
}