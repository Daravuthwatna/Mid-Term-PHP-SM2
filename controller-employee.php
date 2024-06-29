<?php
require('connection.php');

class Employee1 extends Database {
    public function insert_employee($employee, $sex, $dob, $type, $province, $district, $commune, $salary, $status) {
        $sql = "INSERT INTO employee (employee, sex, dob, type, province, district, commune, salary, status) 
                VALUES (:employee, :sex, :dob, :type, :province, :district, :commune, :salary, :status)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'employee' => $employee,
                'sex' => $sex,
                'dob' => $dob,
                'type' => $type,
                'province' => $province,
                'district' => $district,
                'commune' => $commune,
                'salary' => $salary,
                'status' => $status,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Database insertion error: " . $e->getMessage());
            return false;
        }
    }

    public function get_employee() {
        $sql = "SELECT * FROM employee";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function check_employee($employeeName) {
        $sql = "SELECT COUNT(*) as count FROM employee WHERE employee = :employee";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['employee' => $employeeName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function delete_employee($employee) {
        $sql = "DELETE FROM employee WHERE employee = :employee";
        $stmt = $this->conn->prepare($sql);
        try {
            return $stmt->execute(['employee' => $employee]);
        } catch (PDOException $e) {
            error_log("Database deletion error: " . $e->getMessage());
            return false;
        }
    }

    public function get_employee_by_name($employee) {
        $sql = "SELECT * FROM employee WHERE employee = :employee";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(['employee' => $employee]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database retrieval error: " . $e->getMessage());
            return false;
        }
    }
    
    public function update_employee($id, $employee, $sex, $dob, $type, $province, $district, $commune, $salary, $status) {
        $sql = "UPDATE employee SET employee = :employee, sex = :sex, dob = :dob, type = :type, province = :province, district = :district, commune = :commune, salary = :salary, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'employee' => $employee,
                'sex' => $sex,
                'dob' => $dob,
                'type' => $type,
                'province' => $province,
                'district' => $district,
                'commune' => $commune,
                'salary' => $salary,
                'status' => $status,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Database update error: " . $e->getMessage());
            return false;
        }
    }
}
?>
