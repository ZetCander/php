<?php

namespace application\controllers;

use application\lib\Db;
use application\core\View;
use application\core\Router;
use application\core\Controller;
use application\controllers\DepartmentController;
use application\controllers\UserController;

class AdminController extends Controller {

	public function interfaceAction() {

		$this->view->render('Интерфейс админа');
	}

	public function departmentAction() {

		$departments = DepartmentController::getDepartmentFromDB();

		foreach ($departments as &$depInfo) {
			
			$sql = 'SELECT * FROM phones_table WHERE department = :depId';
			$params = [
				'depId' => $depInfo['id'],
			];

			$phones = DB::instance()->all($sql, $params);
			if ($phones) {
				$depInfo['phones'] = $phones;
			}
		}

		$this->view->render('Редактирование отделов', $departments);	
	}

	public function changeUserAction() {
		if (!isset($_GET['id'])) {
			exit(json_encode(['message' => 'Не выбран сотрудник']));
		}
		$id = $_GET['id'];

		if (!$id) {
			exit(json_encode(['message' => 'Не выбран сотрудник']));
		}

		$fullName = $this->getParam('full_name');
		$isAdmin = $this->getParam('admin');

		if ($fullName && $isAdmin && $id) {
			$isAdmin = $isAdmin == 'on' ? 1 : 0;
			(new UserController())->updateUser($id, $fullName, $isAdmin);
			View::message('Информация о пользователе обновлена');
		}
		
		$employee = (new UserController())->getEmployee($id);
		$info = [];
		$info['full_name'] = $employee->getFullName();
		$info['sudo'] = $employee->isAdmin() ? 'on' : null; 
		
		$this->view->render('Редактирование сотрудника', $info);	
	}

	public function changeDepAction() {
		if (!isset($_GET['id'])) {
			exit(json_encode(['message' => 'Не выбран отдел']));
		}
		$id = $_GET['id'];

		if (!$id) {
			exit(json_encode(['message' => 'Не выбран отдел']));
		}

		$name = $this->getParam('name');
		if ($name && $id) {
			(new DepartmentController($this->route, $this->_params))->updateDep($id, $name);
			View::message('Информация об отделе обновлена');
		}
		
		$department = DepartmentController::getDepartmentFromDB($id);
		
		$this->view->render('Редактирование отдела', $department);	
	}

	public function employeeCreateAction() {

		$login = $this->getParam('login');
		$fullName = $this->getParam('full_name');
		$isAdmin = $this->getParam('admin');
		$password = $this->getParam('pass1');
		if ($login && $fullName && isset($isAdmin) && $password) {
			(new AccountController($this->route, $this->_params))
				->createAccount($login, $fullName, $isAdmin, $password);
			View::message('Новый пользователь добавлен.');
		}
		
		$this->view->render('Создание сотрудника');	
	}

	public function departmentCreateAction() {

		$name = $this->getParam('name');
		if ($name) {
			$sql = "INSERT INTO department(name) VALUES(:name)";

			$params = [
				'name' => $name,
			];
			
			DB::instance()->query($sql, $params);

			View::message('Отдел создан');
		}

		$this->view->render('Создание нового отдела');
	}

	public function deleteAction() {

		$id = $_GET['id'];
		$type = $_GET['type'];

		switch($type) {
			case 'user': 
				$table = 'users_table';
				break;
			case 'phone': 
				$table = 'phones_table';
				break;
			case 'department':
				$table = 'department';
				break;
			default:
				View::error('Неправильный тип.');
		}

		$sql = 'DELETE FROM ' . $table . ' WHERE id = :id';

		$params = [
			'id' => $id,
		];

		DB::instance()->query($sql, $params);

		Router::redirect('/');
	}

}