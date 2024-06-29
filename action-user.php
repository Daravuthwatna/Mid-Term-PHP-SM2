<?php
include('controller-user.php');

$emp = new Employee();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === "add_user") {
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['utype']) && !empty($_POST['status'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $status = $_POST['status'];
            $utype = $_POST['utype'];
            if ($emp->insert_user($username, $password, $utype, $status)) {
                echo "User added successfully";
            } else {
                echo "Failed to add user";
            }
        } else {
            echo "Missing required parameters";
        }
    } elseif ($action === 'check_username') {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $row = $emp->check_username($username);
            if ($row > 0) {
                echo "Username already exists";
            } else {
                echo "Username available";
            }
        } else {
            echo "Missing username parameter";
        }
    } elseif ($action === 'delete_user') {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $row = $emp->check_username($username);
            if ($row > 0) {
                if ($emp->delete_user($username)) {
                    echo "User deleted successfully";
                } else {
                    echo "Failed to delete user";
                }
            } else {
                echo "Username not found";
            }
        } else {
            echo "Missing username parameter";
        }
    } elseif ($action === 'get_user') {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $user = $emp->get_user($username);
            echo json_encode($user);
        } else {
            echo "Missing username parameter";
        }
    } elseif ($action === 'update_user') {
        if (isset($_POST['Eid']) && isset($_POST['Eusername']) && isset($_POST['Epassword']) && isset($_POST['Eutype']) && isset($_POST['Estatus'])) {
            $id = $_POST['Eid'];
            $username = $_POST['Eusername'];
            $password = $_POST['Epassword'];
            $type = $_POST['Eutype'];
            $status = $_POST['Estatus'];
            if ($emp->update_user($id, $username, $password, $type, $status)) {
                echo "User updated successfully";
            } else {
                echo "Failed to update user";
            }
        } else {
            echo "Missing required parameters";
        }
    } else {
        echo "Invalid action";
    }
} else {
    echo "No action specified";
}
?>
