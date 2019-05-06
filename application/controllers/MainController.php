<?php

namespace application\controllers;

use application\core\Controller;
use application\controllers\UserController;

class MainController extends Controller {
	
	public function indexAction() {
		$this->view->render('Главная страница');
	}

	public function allPhonesAction() {

		$phones = PhoneController::getAllPhones();

		$phonesInfo = [];
		foreach ($phones as $phone) {
			$department = DepartmentController::getDepartmentFromDB($phone['department']);
			$phonesInfo[$department['name']][] = $phone;
		}

		$this->view->render('Все номера', $phonesInfo);
	}

	public function allEmployeesAction() {

		$users = (new UserController())->getAllEmployees();

		$this->view->render('Все сотрудники', $users);
	}

	public function allDepartmentsAction() {

		$departments = DepartmentController::getDepartmentFromDB();
		
		$this->view->render('Все отделы', $departments);
	}
}