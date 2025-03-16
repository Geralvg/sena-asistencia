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

$class = new Clase();
$classes = $class->getAll(); // Obtener todas las clases
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Asistencia - SENA Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function showModal(message) {
            const modal = document.getElementById('modal');
            const modalMessage = document.getElementById('modal-message');
            modalMessage.textContent = message;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 1000);
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

    <!-- Modal para ingresar horas -->
    <div id="hoursModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="text-lg font-semibold mb-4">Ingresa las horas de asistencia para todos los aprendices:</p>
            <input type="number" id="modalHoursInput" class="w-full px-3 py-2 border rounded-lg mb-4" placeholder="Horas" min="0">
            <div class="flex justify-end">
                <button id="modalCancel" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600 transition duration-300">Cancelar</button>
                <button id="modalConfirm" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">Confirmar</button>
            </div>
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
        <h1 class="text-2xl font-bold mb-6 text-center">Tomar Asistencia</h1>

        <!-- Formulario para seleccionar la clase -->
        <div class="mb-8">
            <label class="block text-gray-700 text-lg font-semibold mb-2">Selecciona una Clase</label>
            <select id="classSelector" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                <option value="0">-- Selecciona una clase --</option>
                <?php foreach ($classes as $cls): ?>
                    <option value="<?= $cls['id'] ?>">
                        <?= $cls['name'] ?> (<?= $cls['date'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Contenedor para mostrar los aprendices -->
        <div id="apprenticesContainer" class="hidden bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Aprendices</h2>
            <button id="markAllPresent" class="bg-green-500 text-white px-4 py-2 rounded-lg mb-4 hover:bg-green-600 transition duration-300">
                Todos asistieron
            </button>
            <form id="attendanceForm" method="POST">
                <table class="w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Nombre del Aprendiz</th>
                            <th class="px-4 py-2 text-left">Asistencia</th>
                            <th class="px-4 py-2 text-left">Horas de Asistencia</th>
                        </tr>
                    </thead>
                    <tbody id="apprenticesList">
                        <!-- Los aprendices se cargarán aquí dinámicamente -->
                    </tbody>
                </table>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition duration-300 shadow-lg mt-4">
                    Guardar Asistencia
                </button>
            </form>
        </div>
    </div>

    <!-- Script para cargar aprendices dinámicamente -->
    <script>
        document.getElementById('classSelector').addEventListener('change', function () {
            const classId = this.value;
            const apprenticesContainer = document.getElementById('apprenticesContainer');
            const apprenticesList = document.getElementById('apprenticesList');

            if (classId > 0) {
                // Ocultar el contenedor y limpiar la lista mientras se carga
                apprenticesContainer.classList.add('hidden');
                apprenticesList.innerHTML = '';

                // Hacer una solicitud AJAX para obtener los aprendices
                fetch(`get_apprentices.php?class_id=${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            // Mostrar los aprendices
                            data.forEach(apprentice => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td class="px-4 py-2">${apprentice.name}</td>
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="attendance[${apprentice.id}]" class="attendanceCheckbox">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="number" name="attendance_hours[${apprentice.id}]" class="attendanceHours w-full px-3 py-2 border rounded-lg" disabled>
                                    </td>
                                `;
                                apprenticesList.appendChild(row);
                            });
                            apprenticesContainer.classList.remove('hidden');
                        } else {
                            showModal('No hay aprendices en esta clase.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showModal('Error al cargar los aprendices.');
                    });
            } else {
                apprenticesContainer.classList.add('hidden');
            }
        });

        // Habilitar campo de horas si el checkbox está marcado
        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('attendanceCheckbox')) {
                const hoursInput = e.target.closest('tr').querySelector('.attendanceHours');
                hoursInput.disabled = !e.target.checked;
                if (!e.target.checked) {
                    hoursInput.value = ''; // Limpiar el campo si no está marcado
                }
            }
        });

        // Mostrar el modal al hacer clic en "Todos asistieron"
        document.getElementById('markAllPresent').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('hoursModal').classList.remove('hidden');
        });

        // Manejar la confirmación del modal
        document.getElementById('modalConfirm').addEventListener('click', function () {
            const hours = document.getElementById('modalHoursInput').value;

            if (hours !== '' && !isNaN(hours)) {
                const checkboxes = document.querySelectorAll('.attendanceCheckbox');
                const hoursInputs = document.querySelectorAll('.attendanceHours');
                checkboxes.forEach(checkbox => checkbox.checked = true);
                hoursInputs.forEach(input => {
                    input.disabled = false;
                    input.value = hours;
                });
                document.getElementById('hoursModal').classList.add('hidden');
            } else {
                showModal('Por favor, ingresa un número válido de horas.');
            }
        });

        // Manejar la cancelación del modal
        document.getElementById('modalCancel').addEventListener('click', function () {
            document.getElementById('hoursModal').classList.add('hidden');
        });

        // Manejar el envío del formulario de asistencia
        document.getElementById('attendanceForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const classId = document.getElementById('classSelector').value;

            fetch('save_attendance.php?class_id=' + classId, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showModal('Asistencia guardada exitosamente.');
                } else {
                    showModal('Error al guardar la asistencia.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('Error al guardar la asistencia.');
            });
        });
    </script>
</body>
</html>