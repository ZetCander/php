<?php

$routes = [];

$routes[''] = [
      'controller' => 'main',
      'action' => 'index'
];

$routes['login'] = [
      'controller' => 'account',
      'action' => 'login'
];

$routes['register'] = [
      'controller' => 'account',
      'action' => 'register'
];

$routes['exit'] = [
      'controller' => 'account',
      'action' => 'exit'
];

$routes['phone/all'] = [
      'controller' => 'main',
      'action' => 'allPhones'
];

$routes['employee/all'] = [
      'controller' => 'main',
      'action' => 'allEmployees'
];

$routes['department/all'] = [
      'controller' => 'main',
      'action' => 'allDepartments'
];

$routes['phone/info'] = [
      'controller' => 'phone',
      'action' => 'info'
];

$routes['employee/info'] = [
      'controller' => 'account',
      'action' => 'info'
];

$routes['department/info'] = [
      'controller' => 'department',
      'action' => 'info'
];

$routes['change/user'] = [
      'controller' => 'admin',
      'action' => 'changeUser'
];

$routes['change/department'] = [
      'controller' => 'admin',
      'action' => 'changeDep'
];

$routes['admin/delete'] = [
      'controller' => 'admin',
      'action' => 'delete'
];

$routes['department/create'] = [
      'controller' => 'admin',
      'action' => 'departmentCreate'
];

$routes['phone/create'] = [
      'controller' => 'phone',
      'action' => 'create'
];

$routes['employee/create'] = [
      'controller' => 'admin',
      'action' => 'employeeCreate'
];