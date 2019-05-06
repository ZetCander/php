<?php

namespace application\core;

use application\core\View;
use application\controllers\UserController;

class Router {
    
    protected $_routes = [];
    protected $_params = [];
    protected $_data = [];

    function __construct() {
        $routes = [];
        require 'application/config/routes.php';
        
        foreach ($routes as $route => $params) {
            $this->addRoute($route, $params);
        }  
    }
    
    public function addRoute($route, $params) {
        $this->_routes[$route] = $params;
    }
    
    public function matchRoute() {
        $uriParts = explode('?', $_SERVER['REQUEST_URI']);
        $uri = trim($uriParts[0], '/');

        foreach ($this->_routes as $route => $params) {
            if (preg_match('#^' . $route . '$#', $uri, $matches)) {
                $this->_params = $params;
                return true;
            }
        }

        return false;
    }
    
    public function runRoute() {

        if ($this->matchRoute()) {
            $this->initData();

            $this->initSession();
            $this->checkAccess();

            $path = 'application\controllers\\' . ucfirst($this->_params['controller']) . 'Controller';

            if (class_exists($path)) {
                $action = $this->_params['action'] . 'Action';

                if (method_exists($path, $action)) {
                    $controller = new $path($this->_params, $this->_data);
                    $controller->$action();
                }
                else {
                    View::errorCode(404);
                }

            }
            else {
                View::errorCode(404);
            }
        }
        else {
            View::errorCode(404);
        }
    }

    public function initData() {

        if (!empty($_POST)) {
            $this->_data = array_merge($this->_data, $_POST);
        }

    }

    public static function redirect($url) {
        header('location:' . $url);
        exit;
    }

    public function initSession() {

        if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
            try {
                $params = [
                    'login' => $_COOKIE['login'],
                    'pass_hash' => $_COOKIE['password'],
                ];
                $user = UserController::getUserFromDB($params);
                $userController = new UserController($user);

                $this->_data['userStatus'] = $user->getStatus();
                $userController->authorization($_COOKIE['login'], $_COOKIE['password']);
            }
            catch (Exception $ex) {
                View::error($ex->getMessage());
                SetCookie("login", "", time() - 3600, '/');               
                SetCookie("password", "", time() - 3600, '/');   
            }
        }
        else {
            $this->_data['userStatus'] = 'guest';
        }
    }
    
    public function checkAccess() {
        $public = [];
        require 'application/config/public.php';

        if (!isset($_COOKIE['login']) && !isset($public[$this->_params['action']])) {
            $this->redirect('/login');
        }

        $needSudo = [];
        require 'application/config/admin.php';

        $route = $this->_params['controller'] . '/' . $this->_params['action'];
        if (
            isset($needSudo[$route]) && 
            $this->_data['userStatus'] != "admin" 
        ) {
            $this->redirect('/login');   
        }

        if (
            $this->_data['userStatus'] != 'guest' &&
            ( 
                $this->_params['action'] == 'login' ||
                $this->_params['action'] == 'register'
            )
        ) {
            $this->redirect('/');   
        }

        if (
            $this->_data['userStatus'] != 'admin' &&
            strpos($this->_params['action'], 'create') !== false
        ) {
            View::errorCode(403);
        }
    }
}
