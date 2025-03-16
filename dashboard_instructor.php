<?php
session_start();
require_once 'includes/Auth.php';

if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'instructor') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Instructor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-50 to-purple-50 min-h-screen">

    <!-- Barra de navegación -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">Panel de Instructor</div>
                <div class="flex space-x-4">
                    <a href="logout.php" class="text-gray-700 hover:text-blue-600 font-semibold">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Bienvenido, Instructor</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tarjeta: Tomar Lista -->
            <a href="attendance.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Tomar Lista</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Ver Reportes -->
            <a href="reports.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Ver Reportes</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>

</html>