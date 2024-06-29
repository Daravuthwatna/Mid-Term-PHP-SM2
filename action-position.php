<?php
require('controller-position.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = new Position();

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_position') {
            if (!empty($_POST['position']) && !empty($_POST['description']) && !empty($_POST['status'])) {
                $positionName = htmlspecialchars($_POST['position']);
                $description = htmlspecialchars($_POST['description']);
                $status = htmlspecialchars($_POST['status']);
                $inserted = $position->insert_position($positionName, $description, $status);
                if ($inserted) {
                    echo "Success: Position added successfully";
                } else {
                    echo "Error: Failed to add position";
                }
            } else {
                echo "Error: Missing required parameters";
            }
        } 
        
        elseif ($_POST['action'] === 'delete_posi' && isset($_POST['position'])) {
            $positionName = htmlspecialchars($_POST['position']);
            $deleted = $position->delete_posi($positionName);
            if ($deleted) {
                echo "Success: Position deleted successfully";
            } else {
                echo "Error: Failed to delete position";
            }
        } 

        elseif ($_POST['action'] === 'get_position' && isset($_POST['position'])) {
            $positionName = htmlspecialchars($_POST['position']);
            $data = $position->get_position_by_name($positionName);
            echo json_encode($data);
        } 

        elseif ($_POST['action'] === 'update_position') {
            if (!empty($_POST['position']) && !empty($_POST['description']) && !empty($_POST['status']) && !empty($_POST['original_position'])) {
                $originalPosition = htmlspecialchars($_POST['original_position']);
                $positionName = htmlspecialchars($_POST['position']);
                $description = htmlspecialchars($_POST['description']);
                $status = htmlspecialchars($_POST['status']);
                $updated = $position->update_position($originalPosition, $positionName, $description, $status);
                if ($updated) {
                    echo "Success: Position updated successfully";
                } else {
                    echo "Error: Failed to update position";
                }
            } else {
                echo "Error: Missing required parameters";
            }
        }
        
    }
}
?>
