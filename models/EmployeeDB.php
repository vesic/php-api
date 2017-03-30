<?php

class EmployeeDB {
    public static function getEmployees() {
        $db = Database::getDB();
        $query = "SELECT * FROM employees";
        $statement = $db->query($query);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $employee = new Employee($row['id'], $row['name'], $row['department'], $row['salary']);
            $employees[] = $employee;
        }
        return $employees;
    }
    
    public static function getSingleEmployee($employee_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM employees WHERE id = :employee_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":employee_id", $employee_id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        if ($row !== false) {
            $employee = new Employee($row['id'], $row['name'], $row['department'], $row['salary']);
            return $employee;
        }
        return null;
    }
    
    public static function addEmployee($name, $department, $salary) {
        $db = Database::getDB();
        $query = 'INSERT INTO employees (name, department, salary) 
                    VALUES (:name, :department, :salary)';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':department', $department);
        $statement->bindValue(':salary', $salary);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }

    public static function updateEmployee($id, $name, $department, $salary) {
        $db = Database::getDB();
        $query = 'UPDATE employees SET
                        name = :name,
                        department = :department,
                        salary = :salary 
                    WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':department', $department);
        $statement->bindValue(':salary', $salary);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
    
    public static function deleteEmployee($id) {
        $db = Database::getDB();
        $query = 'DELETE FROM employees WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    }
}
