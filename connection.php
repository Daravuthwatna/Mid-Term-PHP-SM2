<?php
date_default_timezone_set('Asia/Bangkok');
class Database {
    private $dsn = "mysql:host=localhost;dbname=employee";
    private $dbuser = "root";
    private $dbpass = "";
    public $conn;
    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
