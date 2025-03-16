<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Apprentice.php';
require_once 'includes/Group.php';

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'coordinator') {
    header('Location: index.php');
    exit();
}

$apprentice = new Apprentice();
$group = new Group();
$groups = $group->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $group_id = $_POST['group_id'];

    if ($apprentice->create($name, $group_id)) {
        $success_message = "Aprendiz creado exitosamente.";
    } else {
        $error_message = "Error al crear el aprendiz.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Aprendiz - SENA Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Botón de regreso -->
        <a href="dashboard.php" class="absolute top-4 left-4 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>

        <h1 class="text-2xl font-bold mb-4">Crear Aprendiz</h1>
        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= $success_message ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= $error_message ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Nombre del Aprendiz</label>
                <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Ficha (Grupo)</label>
                <select name="group_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" required>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition duration-300 shadow-lg">
                Crear
            </button>
        </form>
    </div>
</body>
</html>