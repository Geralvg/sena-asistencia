<?php
require_once 'Database.php';

class Attendance {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Registrar la asistencia de un aprendiz
    public function create($apprentice_id, $class_id, $status, $hours = null) {
        $stmt = $this->db->prepare("INSERT INTO attendances (apprentice_id, class_id, status, attendance_hours) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $apprentice_id, $class_id, $status, $hours);
        return $stmt->execute();
    }

    // Obtener la asistencia de una clase
    public function getByClass($class_id) {
        $stmt = $this->db->prepare("SELECT * FROM attendances WHERE class_id = ?");
        $stmt->bind_param("i", $class_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getFaultsByApprentice($apprentice_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as faults FROM attendances WHERE apprentice_id = ? AND status = 'absent'");
        $stmt->bind_param("i", $apprentice_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['faults'];
    }
    
    public function getFaultsDetailsByApprentice($apprentice_id) {
        $stmt = $this->db->prepare("SELECT class_id FROM attendances WHERE apprentice_id = ? AND status = 'absent'");
        $stmt->bind_param("i", $apprentice_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>