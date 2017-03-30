<?php

class Employee implements JsonSerializable {
    private $id, $name, $department, $salary;
    
    public function __construct($id, $name, $department, $salary) {
        $this->id = $id;
        $this->name = $name;
        $this->department = $department;
        $this->salary = $salary;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getDepartment() {
        return $this->department;
    }
    
    public function setDeparment($department) {
        $this->department = $department;
    }
    
    public function getSalary() {
        return $this->salary;
    }
    
    public function setSalary($salary) {
        return $this->salary = $salary;
    }
    
    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'department' => $this->getDepartment(),
            'salary' => $this->getSalary()
        ];
    }
}