<?php
require_once 'Database.php';

class Program {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $center_id) {
        $stmt = $this->db->prepare("INSERT INTO programs (name, center_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $center_id);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM programs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>