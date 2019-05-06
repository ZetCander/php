<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class DepartmentController extends Controller {

	public static function getDepartmentFromDB($departmentId = '') {

		$sql = 'SELECT * FROM department';
		$params = [];

		if ($departmentId) {
			$sql .= ' WHERE id = :depId';

			$params['depId'] = $departmentId;
		}

		if ($departmentId) {
			$departmentInfo = Db::instance()->row($sql, $params);
		}
		else {
			$departmentInfo = Db::instance()->all($sql, $params);
		}
		if ($departmentInfo) {
			return $departmentInfo;
		}
		else {
			return [];			
		}
	}

	public static function deleteAction() {
		
	}

	public function infoAction() {
		
		$id = $_GET['id'];
		$sql = 'SELECT * FROM phones_table WHERE department = :depId';

		$params = [
			'depId' => $id,
		];

		$phones = Db::instance()->all($sql, $params);

		$sql = 'SELECT * FROM department WHERE id = :depId';

		$department = Db::instance()->row($sql, $params);

		$info = ['phones' => $phones, 'department' => $department];
		$this->view->render('Информация об отделе', $info);
	}

	public function updateDep($id, $name) {

		$sql = 'UPDATE department SET name = :name WHERE id = :id';

		$params = [
			'id' => $id,
			'name' => $name,
		];

		Db::instance()->query($sql, $params);
	}
}