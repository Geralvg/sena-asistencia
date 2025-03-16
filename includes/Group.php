<?php
require_once 'Database.php';

class Group {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $program_id) {
        $stmt = $this->db->prepare("INSERT INTO groups (name, program_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $program_id);
        return $stmt->execute();
    }

    // Obtener todas las fichas (grupos)
    public function getAll() {
        $result = $this->db->query("SELECT * FROM groups");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>