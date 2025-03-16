<?php
session_start();
require_once 'includes/Auth.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'super_admin') {
    header("Location: index.php");
    exit();
}
require_once 'includes/Database.php';
require 'includes/Regional.php';

$regional = new Regional();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nombre'];
    if ($regional->create($name)) {
        $success_message = "Regional creada exitosamente.";
    } else {
        $error_message = "Error al crear la regional.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Regional</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function showModal(message) {
            const modal = document.getElementById('modal');
            const modalMessage = document.getElementById('modal-message');
            modalMessage.textContent = message;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 3000);
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-purple-50 min-h-screen">
    <!-- Modal para alertas -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p id="modal-message" class="text-lg font-semibold"></p>
        </div>
    </div>

    <!-- Botón de regreso -->
    <a href="dashboard.php" class="absolute top-4 left-4 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">Crear Regional</h2>
            <form method="POST" onsubmit="showModal('Regional creada exitosamente.')">
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre de la Regional</label>
                    <input type="text" name="nombre" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" required>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition duration-300 shadow-lg">
                    Crear
                </button>
            </form>
        </div>
    </div>

    <!-- Mostrar alerta si hay un mensaje de éxito o error -->
    <?php if (isset($success_message)): ?>
        <script>showModal('<?= $success_message ?>');</script>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <script>showModal('<?= $error_message ?>');</script>
    <?php endif; ?>
</body>
</html>