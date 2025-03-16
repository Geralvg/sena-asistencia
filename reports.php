<?php
session_start();
require_once 'includes/Auth.php';
require_once 'includes/Apprentice.php';
require_once 'includes/Attendance.php';
require_once 'includes/Group.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'instructor' && $_SESSION['user_role'] !== 'coordinator')) {
    header('Location: index.php');
    exit();
}

$group = new Group();
$attendance = new Attendance();
$apprentice = new Apprentice();

// Obtener todos los grupos
$groups = $group->getAll();

// Filtrar por grupo si se selecciona uno
$selected_group_id = isset($_GET['group_id']) ? (int)$_GET['group_id'] : 0;
$apprentices_with_faults = [];

if ($selected_group_id > 0) {
    // Obtener todos los aprendices del grupo seleccionado
    $apprentices = $apprentice->getByGroup($selected_group_id);

    // Calcular las faltas de cada aprendiz
    foreach ($apprentices as $apprentice) {
        $faults = $attendance->getFaultsByApprentice($apprentice['id']);
        if ($faults >= 3) {
            $apprentices_with_faults[] = [
                'id' => $apprentice['id'],
                'name' => $apprentice['name'],
                'faults' => $faults
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - SENA Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function showDetails(apprenticeId) {
            fetch(`get_fault_details.php?apprentice_id=${apprenticeId}`)
                .then(response => response.json())
                .then(data => {
                    const modal = document.getElementById('details-modal');
                    const modalContent = document.getElementById('details-content');
                    modalContent.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(fault => {
                            const faultItem = document.createElement('div');
                            faultItem.className = 'mb-2 p-2 bg-gray-100 rounded-lg';
                            faultItem.textContent = `Clase: ${fault.class_name} (${fault.class_date})`;
                            modalContent.appendChild(faultItem);
                        });
                    } else {
                        modalContent.textContent = 'No hay detalles de faltas.';
                    }

                    modal.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function closeModal() {
            document.getElementById('details-modal').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-purple-50 min-h-screen">
    <!-- Modal para detalles de faltas -->
    <div id="details-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Detalles de Faltas</h2>
            <div id="details-content" class="mb-4"></div>
            <button onclick="closeModal()" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Cerrar
            </button>
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
        <h1 class="text-2xl font-bold mb-6 text-center">Reportes de Faltas</h1>

        <!-- Selector de grupo -->
        <form method="GET" class="mb-8">
            <label class="block text-gray-700 text-lg font-semibold mb-2">Selecciona un Grupo</label>
            <select name="group_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                <option value="0">-- Selecciona un grupo --</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>" <?= $selected_group_id == $group['id'] ? 'selected' : '' ?>>
                        <?= $group['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition duration-300 shadow-lg mt-4">
                Filtrar
            </button>
        </form>

        <!-- Lista de aprendices con 3 o más faltas -->
        <?php if ($selected_group_id > 0): ?>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Aprendices con 3 o más faltas</h2>
                <div class="space-y-4">
                    <!-- Encabezados -->
                    <div class="grid grid-cols-3 gap-4 bg-gray-100 p-4 rounded-lg">
                        <div class="font-semibold">Nombre del Aprendiz</div>
                        <div class="font-semibold">Faltas</div>
                        <div class="font-semibold">Acciones</div>
                    </div>

                    <!-- Aprendices -->
                    <?php if (!empty($apprentices_with_faults)): ?>
                        <?php foreach ($apprentices_with_faults as $apprentice): ?>
                            <div class="grid grid-cols-3 gap-4 p-4 border-b border-gray-200">
                                <div><?= $apprentice['name'] ?></div>
                                <div><?= $apprentice['faults'] ?></div>
                                <div>
                                    <button onclick="showDetails(<?= $apprentice['id'] ?>)" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                        Detalles
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center p-4">No hay aprendices con 3 o más faltas en este grupo.</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>