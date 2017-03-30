<?php

interface EmployeeRepositoryInterface {
    public function getEmployees();
    public function getSingleEmployee($employee_id);
    public function addEmployee($name, $department, $salary);
    public function updateEmployee($id, $name, $department, $salary);
    public function deleteEmployee($id);
}
