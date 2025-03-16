<?php
session_start();
require_once 'includes/Auth.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'super_admin') {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-50 to-purple-50 min-h-screen">

    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">Panel de Super Admin</div>
                <div class="flex space-x-4">
                    <a href="logout.php" class="text-gray-700 hover:text-blue-600 font-semibold">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Bienvenido, Super Admin</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tarjeta: Crear Regional -->
            <a href="crear_regional.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Regional</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Centro -->
            <a href="crear_centro.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Centro</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Coordinador -->
            <a href="register.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Coordinador</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>

</html>