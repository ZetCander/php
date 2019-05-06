<?php

namespace application\lib;

use PDO;

class Db {

	protected $db;
	protected static $_instance = null;

	private function __construct() {

		$config = require 'application/config/db.php';
		$this->db = new PDO(
				'mysql:host=' . $config['host']
				. ';dbname=' . $config['dbname'],
				$config['user'],
				$config['password']
		);
	}

	public function query($sql = '', $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {

			foreach ($params as $key => $param) {
				$stmt->bindValue(':' . $key, $param);
			}
		}

		$stmt->execute();
		return $stmt;
	}

	public function column($sql, $params = []) {
		return $this->query($sql, $params)->fetchColumn();
	}

	public function row($sql, $params = []) {
		return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
	}

	public function all($sql, $params = []) {
		return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function instance() {

		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function getDb() {
		return $this->db;
	}

	private function __clone() {
    }

    private function __wakeup() {
    }     
}