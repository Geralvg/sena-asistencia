<?php
require_once 'Database.php';

class Apprentice {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear un aprendiz
    public function create($name, $group_id) {
        $stmt = $this->db->prepare("INSERT INTO apprentices (name, group_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $group_id);
        return $stmt->execute();
    }

    // Obtener todos los aprendices de una ficha (grupo)
    public function getByGroup($group_id) {
        $stmt = $this->db->prepare("SELECT * FROM apprentices WHERE group_id = ?");
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAll() {
        $result = $this->db->query("SELECT * FROM apprentices");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
}
?>