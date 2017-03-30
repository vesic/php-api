<?php

class EmployeesController {
    public static function index() {
        $employees = EmployeeDB::getEmployees();
        header('Content-Type: application/json');
        return json_encode($employees);
    }
    
    public static function show($id) {
        $employee = EmployeeDB::getSingleEmployee($id);
        $response = ($employee) 
            ? json_encode($employee)
            : json_encode([error => "Employee not found"]);
        header('Content-Type: application/json');
        return $response;
    }
    
    public static function store() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = json_encode([
            'status' => [
                'error' => 'All fields required'  
            ]    
        ]);
        if ($_POST['name'] && $_POST['department'] && $_POST['salary']) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
            $salary = filter_var($_POST['salary'],FILTER_SANITIZE_STRING);
            $new_employee = EmployeeDB::addEmployee($name, $department, $salary);
            $response =  ($new_employee !== false)
                ? json_encode([
                    'status' => [
                        'success' => 'Employee created'    
                    ]
                ])
                : json_encode([
                    'status' => [
                        'error' => 'Error creating employee'   
                    ]    
                ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
    
    public static function destroy($id) {
        $deleted_employee = EmployeeDB::deleteEmployee($id);
        $response = json_encode([
            'status' => [
                'error' => 'Error deleting employee'   
            ] 
        ]);
        if ($deleted_employee !== false) {
            $response = json_encode([
                'status' => [
                    'sucess' => "Employee deleted"  
                ]
            ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
    
    public static function update($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = json_encode([
            'status' => [
                'error' => 'All fields required'  
            ]
        ]);
        if ($_POST['name'] && $_POST['department'] && $_POST['salary']) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
            $salary = filter_var($_POST['salary'],FILTER_SANITIZE_STRING);
            $updateEmployeeCount = EmployeeDB::updateEmployee($id, $name, $department, $salary);
            $response =  ($updateEmployeeCount !== false)
                ? json_encode([
                    'status' => [
                        'success' => 'Employee update'    
                    ]
                ])
                : json_encode([
                    'status' => [
                        'error' => 'Error updating employee'   
                    ]    
                ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
}