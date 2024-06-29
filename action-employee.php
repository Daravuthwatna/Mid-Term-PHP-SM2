<?php
require('controller-employee.php');
$employee = new Employee1();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add_employee') {
        $employeeName = htmlspecialchars($_POST['employee']);
        $sex = htmlspecialchars($_POST['sex']);
        $dob = htmlspecialchars($_POST['dob']);
        $type = htmlspecialchars($_POST['type']);
        $province = htmlspecialchars($_POST['province']);
        $district = htmlspecialchars($_POST['district']);
        $commune = htmlspecialchars($_POST['commune']);
        $salary = htmlspecialchars($_POST['salary']);
        $status = htmlspecialchars($_POST['status']);

        if (!empty($employeeName) && !empty($sex) && !empty($dob) && !empty($type) && !empty($province) && !empty($district) && !empty($commune) && !empty($salary) && !empty($status)) {
            $inserted = $employee->insert_employee($employeeName, $sex, $dob, $type, $province, $district, $commune, $salary, $status);
            if ($inserted) {
                echo "Success: Employee added successfully";
            } else {
                echo "Error: Failed to add employee";
            }
        } else {
            echo "Error: Missing required parameters";
        }
    } 
    elseif (isset($_POST['action']) && $_POST['action'] === 'delete_employee' && isset($_POST['employee'])) {
        $employeeName = htmlspecialchars($_POST['employee']);
        if (!empty($employeeName)) {
            $deleted = $employee->delete_employee($employeeName);
            if ($deleted) {
                echo "Success: Employee deleted successfully";
            } else {
                echo "Error: Failed to delete employee";
            }
        } else {
            echo "Error: Employee name is required";
        }
    } 
    elseif (isset($_POST['action']) && $_POST['action'] === 'check_employee' && isset($_POST['employee'])) {
        $employeeName = htmlspecialchars($_POST['employee']);
        if (!empty($employeeName)) {
            $row = $employee->check_employee($employeeName);
            if ($row > 0) {
                echo "Employee already exists";
            } else {
                echo "Employee available";
            }
        } else {
            echo "Error: Employee name is required";
        }
    }  
    elseif (isset($_POST['action']) && $_POST['action'] === 'get_employee' && isset($_POST['employee'])) {
        $employeeName = htmlspecialchars($_POST['employee']);
        if (!empty($employeeName)) {
            $data = $employee->get_employee_by_name($employeeName);
            echo json_encode($data);
        } else {
            echo "Error: Employee name is required";
        }
    }
    elseif ($_POST['action'] === 'update_employee') {
        if (!empty($_POST['id']) && !empty($_POST['employee']) && !empty($_POST['sex']) && !empty($_POST['dob']) && !empty($_POST['type']) && !empty($_POST['province']) && !empty($_POST['district']) && !empty($_POST['commune']) && !empty($_POST['salary']) && !empty($_POST['status'])) {
            $id = htmlspecialchars($_POST['id']);
            $employeeName = htmlspecialchars($_POST['employee']);
            $sex = htmlspecialchars($_POST['sex']);
            $dob = htmlspecialchars($_POST['dob']);
            $type = htmlspecialchars($_POST['type']);
            $province = htmlspecialchars($_POST['province']);
            $district = htmlspecialchars($_POST['district']);
            $commune = htmlspecialchars($_POST['commune']);
            $salary = htmlspecialchars($_POST['salary']);
            $status = htmlspecialchars($_POST['status']);
            $updated = $employee->update_employee($id, $employeeName, $sex, $dob, $type, $province, $district, $commune, $salary, $status);
            if ($updated) {
                echo "Success: Employee updated successfully";
            } else {
                echo "Error: Failed to update employee";
            }
        } else {
            echo "Error: Missing required parameters";
        }
    }
}
?>
