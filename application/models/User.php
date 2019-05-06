<?php

namespace application\models;

class User {

	protected $_id = null;
	protected $_status = null;
	protected $_fullName = null;
	protected $_phone = null;

	public function __construct($params) {
		$this->_id = $params['id'];
		$this->_status = $params['sudo'] == 1 ? 'admin' : 'user';
		$this->_fullName = $params['full_name'];
	}

	public function getId() {
		return $this->_id;
	}

	public function getPhone() {
		return $this->_phone;
	}

	public function getStatus() {
		return $this->_status;
	}

	public function isAdmin() {
		return $this->_status == 'admin';
	}

	public function getFullName() {
		return $this->_fullName;
	}
}