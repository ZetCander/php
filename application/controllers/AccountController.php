<?php

namespace application\controllers;

use application\controllers\UserController;
use application\core\Controller;
use application\core\Router;
use application\core\View;
use application\lib\Date;
use application\lib\Db;
use Exception;

class AccountController extends Controller {

	public $userStatus = 'guest';
	protected $_salt = 'a2TZb8';
	protected $_userController = null;
	
	public function loginAction() {
		$login = $this->getParam('login');
		$passwd = $this->getParam('password');
		if ($login && $passwd) {
			try {
				$passwdHash = hash('md5', $passwd . $this->_salt);

				$params = [
                    'login' => $login,
                    'pass_hash' => $passwdHash,
                ];
				$user = UserController::getUserFromDB($params);
 				
				$this->_userController = new UserController($user);
				$this->_userController->authorization($login, $passwdHash);

				View::message('Здравствуйте,' . $user->getFullName() . ', вы успешно авторизовались');
			}
			catch (Exception $ex) {
				View::message('Такого пользователя не существует.');
			}

		}

		$this->view->render('Вход');
	}

	public function registerAction() {
		$login = $this->getParam('login');
		$passwd = $this->getParam('password');
		$fullName = $this->getParam('full_name');
		if ($login && $passwd) {
			try {
				$passwdHash = hash('md5', $passwd . $this->_salt);
				$userController = new UserController();
				$userController->registration($login, $passwdHash, $fullName);
			}
			catch (Exception $ex) {
				View::message('Во время регистрации произошла ошибка: ' . $ex->getMessage());
			}
		}

		$this->view->render('Регистрация');
	}

	public function exitAction() {
		$userController = new UserController();
		$userController->exitAccount();
		$this->view->render('Выход');
	}

    public function getUserStatus() {
    	return $this->userStatus;
    }

	public function createAccount($login, $fullName, $isAdmin, $passwd) {
		
		$isAdmin = $isAdmin == 'on' ? 1 : 0;
		$passwdHash = hash('md5', $passwd . $this->_salt);
		(new UserController())->createUser($login, $fullName, $isAdmin, $passwdHash);
	}

	public function infoAction() {

		$id = $_GET['id'];
		$sql = 'SELECT * FROM phones_table WHERE user = :userId';

		$params = [
			'userId' => $id,
		];

		$phones = Db::instance()->all($sql, $params);

		$sql = 'SELECT * FROM users_table WHERE id = :userId';

		$user = Db::instance()->row($sql, $params);

		$info = ['phones' => $phones, 'user' => $user];
		$this->view->render('Информация о сотруднике', $info);
	}
}