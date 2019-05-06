<?php

namespace application\core;

use application\core\View;
use application\core\Router;
use application\controller\UserController;

abstract class Controller {
	
	public $route;
	public $view;
	public $model;
	protected $_params = null;

	public function __construct($route, $params = null) {
		$this->route = $route;
		$this->view = new View($route);
		$this->model = $this->loadModel($this->route['controller']);

		if (isset($params)) {
			$this->_params = $params;
		}
  }

    public function loadModel($name) {
    	$path = 'application\models\\' . ucfirst($name);

    	if (class_exists($path)) {
    		return new $path;
    	}
    }

    public function getParam($key) {

    	if (isset($this->_params[$key])) {
    		return $this->_params[$key];
    	}

    	return false;
    }

    public function getParams() {
    	return $this->_params;
    }

    public function isAdmin() {

        $userStatus = $this->getParam('userStatus');
        if ($userStatus) {
            return $userStatus == 'admin';
        }
        return false;
    }

}