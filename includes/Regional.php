<?php
require_once 'Database.php';

class Regional {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear una regional
    public function create($name) {
        $stmt = $this->db->prepare("INSERT INTO regionals (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    // Obtener todas las regionales
    public function getAll() {
        $result = $this->db->query("SELECT * FROM regionals");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>