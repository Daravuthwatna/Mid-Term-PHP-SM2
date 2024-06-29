<?php
require('connection.php');

class Position extends Database {
    public function insert_position($position, $description, $status) {
        $sql = "INSERT INTO position (position, description, status) VALUES (:position, :description, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'position' => $position,
            'description' => $description,
            'status' => $status
        ]);
        return true;
    }

    public function get_position() {
        $sql = "SELECT * FROM position";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_position_by_name($position) {
        $sql = "SELECT * FROM position WHERE position = :position";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['position' => $position]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update_position($originalPosition, $newPosition, $description, $status) {
        $sql = "UPDATE position SET position = :newPosition, description = :description, status = :status WHERE position = :originalPosition";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'newPosition' => $newPosition,
            'description' => $description,
            'status' => $status,
            'originalPosition' => $originalPosition
        ]);
        return true;
    }

    public function delete_posi($position) {
        $sql = "DELETE FROM position WHERE position = :position";
        $stmt = $this->conn->prepare($sql);
        try {
            if ($stmt->execute(['position' => $position])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Database deletion error: " . $e->getMessage());
            return false;
        }
    }
}
?>
