<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Apprentice.php';
require_once 'includes/Class.php';
require_once 'includes/Attendance.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'instructor' && $_SESSION['user_role'] !== 'coordinator')) {
    header('Location: index.php');
    exit();
}

$class_id = isset($_GET['class_id']) ? (int)$_GET['class_id'] : 0;

if ($class_id > 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendance = new Attendance();
    $apprentice = new Apprentice();
    $class = new Clase();

    // Obtener los detalles de la clase
    $classDetails = $class->getById($class_id);
    if (!$classDetails) {
        echo json_encode(['success' => false, 'message' => 'Clase no encontrada.']);
        exit();
    }

    // Obtener todos los aprendices del grupo de la clase
    $apprentices = $apprentice->getByGroup($classDetails['group_id']);
    if (empty($apprentices)) {
        echo json_encode(['success' => false, 'message' => 'No hay aprendices en esta clase.']);
        exit();
    }

    $success = true;

    // Iterar sobre todos los aprendices
    foreach ($apprentices as $apprentice) {
        $apprentice_id = $apprentice['id'];
        $status = isset($_POST['attendance'][$apprentice_id]) ? 'present' : 'absent'; // Verificar si está marcado
        $hours = isset($_POST['attendance_hours'][$apprentice_id]) ? (int)$_POST['attendance_hours'][$apprentice_id] : null;

        // Guardar la asistencia
        if (!$attendance->create($apprentice_id, $class_id, $status, $hours)) {
            $success = false;
        }
    }

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false]);
}
?>