<?php
require_once 'Database.php';

class Center {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear un centro
    public function create($name, $regional_id) {
        $stmt = $this->db->prepare("INSERT INTO centers (name, regional_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $regional_id);
        return $stmt->execute();
    }

    // Obtener todos los centros de una regional
    public function getByRegional($regional_id) {
        $stmt = $this->db->prepare("SELECT * FROM centers WHERE regional_id = ?");
        $stmt->bind_param("i", $regional_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM centers");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>