<?php 

namespace application\lib;

class Date {

	public static function getDateAndTimeInMoscow() {
		
		date_default_timezone_set('Europe/Moscow');
		
		return date("Y-m-d H:i:s");
	}
}