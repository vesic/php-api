<?php

class EmployeesController {
    protected $repository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->repository = $employeeRepository;
    }

    public function index() {
        $employees = $this->repository->getEmployees();
        header('Content-Type: application/json');
        return json_encode([
            'data' => $employees
        ]);
    }
    
    public function show($id) {
        $employee = $this->repository->getSingleEmployee($id);
        $response = ($employee) 
            ? json_encode($employee)
            : json_encode([error => "Employee not found"]);
        header('Content-Type: application/json');
        return $response;
    }
    
    public function store() {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = json_encode([
            'status' => [
                'message' => 'All fields are required'  
            ]    
        ]);
        if ($_POST['name'] && $_POST['department'] && $_POST['salary']) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
            $salary = filter_var($_POST['salary'],FILTER_SANITIZE_STRING);
            $new_employee = $this->repository->addEmployee($name, $department, $salary);
            $response =  ($new_employee !== false)
                ? json_encode([
                    'status' => [
                        'message' => 'Employee successfully created'    
                    ]
                ])
                : json_encode([
                    'status' => [
                        'message' => 'Fail to create employee'   
                    ]    
                ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
    
    public function update($id) {
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response = json_encode([
            'status' => [
                'message' => 'All fields are required!'  
            ]
        ]);
        if ($_POST['name'] && $_POST['department'] && $_POST['salary']) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
            $salary = filter_var($_POST['salary'],FILTER_SANITIZE_STRING);
            $updateEmployeeCount = $this->repository->updateEmployee($id, $name, $department, $salary);
            $response = ($updateEmployeeCount !== false)
                ? json_encode([
                    'status' => [
                        'message' => 'Employee successfully updated'    
                    ]
                ])
                : json_encode([
                    'status' => [
                        'message' => 'Fail employee update'   
                    ]    
                ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
    
    public function destroy($id) {
        $deleted_employee = $this->repository->deleteEmployee($id);
        $response = json_encode([
            'status' => [
                'message' => 'Fail to delete employee'   
            ] 
        ]);
        if ($deleted_employee !== false) {
            $response = json_encode([
                'status' => [
                    'message' => "Employee successfully deleted"  
                ]
            ]);
        }
        header('Content-Type: application/json');
        return $response;
    }
}
