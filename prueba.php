<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Apprentice.php';
require_once 'includes/Class.php';
require_once 'includes/Attendance.php';

if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'instructor' && $_SESSION['user']['role'] !== 'coordinator')) {
    header('Location: index.php');
    exit();
}

$apprentice = new Apprentice();
$class = new Clase();
$attendance = new Attendance();

// Obtener todas las clases disponibles
$classes = $class->getAll();

// Obtener el ID de la clase desde la URL (si se seleccionó una clase)
$class_id = isset($_GET['class_id']) ? (int)$_GET['class_id'] : 0;

// Si se seleccionó una clase, obtener sus detalles y los aprendices
if ($class_id > 0) {
    $classDetails = $class->getById($class_id);
    if (!$classDetails) {
        die("Clase no encontrada.");
    }
    $apprentices = $apprentice->getByGroup($classDetails['group_id']);
}

// Procesar el formulario de asistencia (si se envió)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $class_id > 0) {
    foreach ($apprentices as $apprentice) {
        $status = isset($_POST['attendance'][$apprentice['id']]) ? 'present' : 'absent';
        $attendance->create($apprentice['id'], $class_id, $status);
    }
    $success = "Asistencia registrada exitosamente.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Asistencia - SENA Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <a href="dashboard.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-block mb-4">
            Regresar al Dashboard
        </a>

        <h1 class="text-2xl font-bold mb-4">Tomar Asistencia</h1>

        <!-- Lista de clases disponibles -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Selecciona una Clase</h2>
            <ul class="space-y-2">
                <?php foreach ($classes as $cls): ?>
                    <li>
                        <a href="take_attendance.php?class_id=<?php echo $cls['id']; ?>" class="text-blue-500 hover:underline">
                            <?php echo $cls['name']; ?> (<?php echo $cls['date']; ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Formulario de asistencia (solo si se seleccionó una clase) -->
        <?php if ($class_id > 0): ?>
            <h2 class="text-xl font-semibold mb-4">Tomar Asistencia - <?php echo $classDetails['name']; ?></h2>
            <h3 class="text-lg mb-4">Fecha: <?php echo $classDetails['date']; ?></h3>

            <?php if (isset($success)): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="take_attendance.php?class_id=<?php echo $class_id; ?>" method="POST">
                <table class="w-full bg-white border rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre del Aprendiz</th>
                            <th class="px-4 py-2">Asistencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($apprentices as $apprentice): ?>
                            <tr>
                                <td class="px-4 py-2"><?php echo $apprentice['name']; ?></td>
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="attendance[<?php echo $apprentice['id']; ?>]" value="1">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Guardar Asistencia</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>