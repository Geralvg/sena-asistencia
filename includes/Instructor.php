<?php
require_once 'Database.php';

class Instructor {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO instructors (name, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $user_id);
        return $stmt->execute();
    }
}
?>