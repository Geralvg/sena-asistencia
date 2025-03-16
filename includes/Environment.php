<?php
require_once 'Database.php';

class Environment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $center_id) {
        $stmt = $this->db->prepare("INSERT INTO environments (name, center_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $center_id);
        return $stmt->execute();
    }
}
?>