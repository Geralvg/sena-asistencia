<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Attendance.php';
require_once 'includes/Class.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'instructor' && $_SESSION['user_role'] !== 'coordinator')) {
    header('Location: index.php');
    exit();
}

$apprentice_id = isset($_GET['apprentice_id']) ? (int)$_GET['apprentice_id'] : 0;

if ($apprentice_id > 0) {
    $attendance = new Attendance();
    $class = new Clase();

    // Obtener todas las faltas del aprendiz
    $faults = $attendance->getFaultsDetailsByApprentice($apprentice_id);

    // Obtener los detalles de las clases en las que faltó
    $fault_details = [];
    foreach ($faults as $fault) {
        $class_details = $class->getById($fault['class_id']);
        if ($class_details) {
            $fault_details[] = [
                'class_name' => $class_details['name'],
                'class_date' => $class_details['date']
            ];
        }
    }

    echo json_encode($fault_details);
} else {
    echo json_encode([]);
}
?>