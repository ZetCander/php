<?php

namespace application\controllers;

use application\lib\Db;
use application\core\View;
use application\core\Controller;

class PhoneController extends Controller {

	protected $_phone = null;

	public function setPhone($phone) {
		$this->_phone = $phone;
	}

	public function departmentAction() {
		
		$sql = 'SELECT * FROM phones_table WHERE department = :departmentId';
		$params = [
			'departmentId' => $departmentId,
		];

		$phones = Db::instance()->all($sql, $params);

		$this->view->render('Номер отдела', $phones);
	}

	public function employeeAction() {
		
		$sql = 'SELECT * FROM phones_table WHERE employee = :employeeId';
		$params = [
			'employeeId' => $employeeId,
		];

		$phones = Db::instance()->all($sql, $params);

		$this->render->view('Номера сотрудника', $phones);
	}

	public function createAction() {

		$user = $this->getParam('user');
		$info = $this->getParam('info');
		$number = $this->getParam('number');
		$department = $this->getParam('department');
		if ($number && $user && $info && $department) {
			$this->saveNewPhone($number, $user, $department, $info);
			View::message('Номер ' . $number . ' добавлен в список.');
		}

		$employees = UserController::getAllEmployees();
		$departments = DepartmentController::getDepartmentFromDB();

		$info = [
			'employees' => [],
			'departments' => [],
		];
		foreach ($employees as $employee) {
			$id = $employee['id'];
			$info['employees'][$id] = $employee['full_name'];
		}
		
		foreach ($departments as $department) {
			$id = $department['id'];
			$info['departments'][$id] = $department['name'];
		}

		$this->view->render('Добавить номер', $info);
	}

	public function allAboutPhone($id) {

		$sql = 'SELECT * FROM phones_table WHERE id = :id';
		$params = [
			'id' => $id,
		];

		$phone = Db::instance()->row($sql, $params);
		$department = DepartmentController::getDepartmentFromDB($phone['department']);
		$phone['depName'] = $department['name'];
		$phone['depId'] = $department['id'];
		
		$user = (new UserController())->getEmployee($phone['user']);
		$phone['userName'] = $user->getFullName();
		$phone['userId'] = $user->getId();

		return $phone;
	}

	public function infoAction() {

		$info = [];
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$info = $this->allAboutPhone($id);
		}

		$this->view->render('Номер телефона', $info);
	}

	public function getPhoneFromDB($cond = '', $params = []) {

		$sql = 'SELECT * FROM phones_table';
		$sql .= ' WHERE ' . $cond;
		$phone = Db::instance()->row($sql, $params);

		return $phone; 
	}

	public static function getAllPhones() {

		$sql = 'SELECT * FROM phones_table';
		$phones = Db::instance()->all($sql);

		return $phones;
	}

	protected function saveNewPhone($number, $user, $department, $description) {

		$sql = 'INSERT INTO phones_table (number, user, department, description)';
		$sql .= ' VALUES (:number, :user, :department, :description)';
		$params = [
			'user' => $user,
			'number' => $number,
			'department' => $department,
			'description' => $description,
		];

		try {
			Db::instance()->query($sql, $params);
		}
		catch (Exception $ex) {
			throw Exception('Произошла ошибка на сервере, пожалуйста, свяжитесь с владельцем.');
		}
	}
}