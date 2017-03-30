<?php

require_once __DIR__ . '/vendor/autoload.php';

require './model/database.php';
require './model/Employee.php';
require './model/EmployeeRepositoryInterface.php';
require './model/EmployeeRepository.php';
require './controller/EmployeesController.php';

$klein = new \Klein\Klein();

$controller = new EmployeesController(new EmployeeRepository());

$klein->respond('GET', '/', function () {
    return 'Hello, world!';
});

$klein->respond('GET', '/employees', function () use ($controller) {
    return $controller->index();
});

$klein->respond('GET', '/employees/[:id]', function ($request) use ($controller) {
    return $controller->show($request->id);
});

$klein->respond('POST', '/employees', function () use ($controller) {
    return $controller->store();
});

$klein->respond('POST', '/employees/[:id]', function ($request) use ($controller) {
    return $controller->update($request->id);
});

$klein->respond('DELETE', '/employees/[:id]', function($request) use ($controller) {
   return $controller->destroy($request->id); 
});

$klein->dispatch();
