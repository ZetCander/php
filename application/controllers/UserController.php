<?php 

namespace application\controllers;

use application\models\User;
use application\lib\Date;
use application\lib\Db;
use Exception;

class UserController {

	protected $_user = null;
	protected $_userStatus = 'guest';

	public function __construct($user = null) {
		$this->_user = $user;
	}

	public static function getUserFromDB($params = []) {

		$sql = 'SELECT * FROM users_table';

		if ($params) {
			$sql .= ' WHERE ';

			$arrOfCond = [];
			foreach ($params as $key => $param) {
				$arrOfCond[] = ':' . $key . '=' . $key;
			}

			$sql .= implode(' AND ', $arrOfCond);
		}

		$userData = Db::instance()->all($sql, $params);
		if ($userData && $params) {
			return new User($userData[0]);
		}
		elseif ($userData) {
			return $userData;
		}
		else {
			throw new Exception('There is no user with params: ' . var_dump($params));
		}
	}

	public function getUser() {
		return $this->_user;
	}


	protected function justAuthorized() {

		$sql = 'UPDATE users_table SET last_auth = :last_auth WHERE id = :id';
		$params = [
			'last_auth' => Date::getDateAndTimeInMoscow(),
			'id' => $this->_user->getId(),
		];

		Db::instance()->query($sql, $params);
	}

    public function authorization($login, $passwdHash) {

		setcookie ("password", $passwdHash, time() + 3600, '/'); 					
		setcookie ("login", $login, time() + 3600, '/'); 						
		$_SESSION['id'] = $this->_user->getId();

		$this->justAuthorized();
	}

	public function registration($login, $passwHash, $fullName) {

		$sql = 'INSERT INTO users_table (login, pass_hash, full_name) VALUES (:login, :passHash, :full_name)';
		$params = [
			'login' => $login,
			'passHash' => $passwdHash,
			'full_name' => $fullName,
		];

		try {
			Db::instance()->query($sql, $params);

			$params = [
                'login' => $login,
                'pass_hash' => $passwdHash,
            ];
			$user = self::getUserFromDB($params);
			$this->_user = $user;
		
			$this->authorization($login, $passwHash);
		}
		catch (Exception $ex) {
			throw Exception('Произошла ошибка на сервере, пожалуйста, свяжитесь с владельцем.');
		}
	}

	public static function getAllEmployees() {

		$usersData = self::getUserFromDB();

		return $usersData;
	}

	public static function getEmployee($id) {

		$params =[
			'id' => $id,
		];
		$user = self::getUserFromDB($params);

		return $user;
	}

	public function exitAccount() {
		setcookie ("password", '', time() - 3600, '/'); 					
		setcookie ("login", '', time() - 3600, '/'); 						
		unset($_SESSION['id']);
	}

	public function updateUser($id, $fullName, $isAdmin) {

		$sql = 'UPDATE users_table SET full_name = :full_name, sudo = :sudo WHERE id = :id';

		$params = [
			'id' => $id,
			'full_name' => $fullName,
			'sudo' => $isAdmin
		];

		Db::instance()->query($sql, $params);
	}

	public function createUser($login, $fullName, $isAdmin, $passwdHash) {

		$sql = 'INSERT INTO users_table (login, full_name, sudo, pass_hash) 
					VALUES(:login, :full_name, :sudo, :pass_hash)';

		$params = [
			'login' => $login,
			'full_name' => $fullName,
			'sudo' => $isAdmin,
			'pass_hash' => $passwdHash
		];

		Db::instance()->query($sql, $params);
	}

}