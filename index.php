<?php
require_once __DIR__ . '/vendor/autoload.php';

require './model/database.php';
require './model/Employee.php';
require './model/EmployeeDB.php';
require './controllers/EmployeesController.php';

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function () {
    return 'Hello, world!';
});

$klein->respond('GET', '/employees', function () {
    return EmployeesController::index();
});

$klein->respond('GET', '/employees/[:id]', function ($request) {
    return EmployeesController::show($request->id);
});


$klein->respond('POST', '/employees', function () {
    return EmployeesController::store();
});

$klein->respond('POST', '/employees/[:id]', function ($request) {
    return EmployeesController::update($request->id);
});

$klein->respond('DELETE', '/employees/[:id]', function($request) {
   return EmployeesController::destroy($request->id); 
});

$klein->dispatch();