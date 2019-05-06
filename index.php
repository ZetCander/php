<?php

require_once 'application/lib/Dev.php';

use application\core\Router;
use application\core\View;

// Вызывается перед выводом ошибки о том, что класс не подключен
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

function exception_handler($exception) {
  echo "Неперехваченное исключение: " , $exception->getMessage(), "\n";
  SetCookie("login", "", time() - 3600, '/');               
  SetCookie("password", "", time() - 3600, '/');   
}
set_exception_handler('exception_handler');

session_start();

$router = new Router();
$router->runRoute();
