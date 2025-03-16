<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Apprentice.php';
require_once 'includes/Class.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'instructor' && $_SESSION['user_role'] !== 'coordinator')) {
    header('Location: index.php');
    exit();
}

$class_id = isset($_GET['class_id']) ? (int)$_GET['class_id'] : 0;

if ($class_id > 0) {
    $class = new Clase();
    $apprentice = new Apprentice();
    $classDetails = $class->getById($class_id);

    if ($classDetails) {
        $apprentices = $apprentice->getByGroup($classDetails['group_id']);
        echo json_encode($apprentices); // Devuelve los aprendices en formato JSON
    } else {
        echo json_encode([]); // Si no hay clase, devuelve un array vacío
    }
} else {
    echo json_encode([]); // Si no hay class_id, devuelve un array vacío
}
?>