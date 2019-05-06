<?php

namespace application\controllers\errors;

class ErrorPage {

	public static function printError($code) {
		echo 'Ошибка ' . $code;
	}
}