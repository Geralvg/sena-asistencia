<?php
require_once 'Database.php';

class Clase {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear una nueva clase
    public function create($name, $date, $group_id) {
        $stmt = $this->db->prepare("INSERT INTO classes (name, date, group_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $date, $group_id);
        return $stmt->execute();
    }

    // Obtener todas las clases
    public function getAll() {
        $result = $this->db->query("SELECT * FROM classes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Retorna un array asociativo con los datos de la clase
    }
}
?>