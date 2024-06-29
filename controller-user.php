<?php
require('connection.php');

class Employee extends Database {
    public function insert_user($username, $password, $type, $status) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO login_user (username, password, type, status) VALUES (:username, :password, :type, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
            'type' => $type,
            'status' => $status
        ]);
        return true;
    }

    public function get_users() {
        $sql = "SELECT * FROM login_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function check_username($username) {
        $sql = "SELECT * FROM login_user WHERE username=:username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        $count = $stmt->rowCount();
        return $count;
    }

    public function delete_user($username) {
        $sql = "DELETE FROM login_user WHERE username=:username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->rowCount() > 0;
    }

    public function get_user($username) {
        $sql = "SELECT * FROM login_user WHERE username=:username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update_user($id, $username, $password, $type, $status) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE login_user SET username=:username, password=:password, type=:type, status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'username' => $username,
            'password' => $hashed_password,
            'type' => $type,
            'status' => $status
        ]);
        return $stmt->rowCount() > 0;
    }
}
?>
