
<?php
session_start();
require_once 'includes/Auth.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'coordinator') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-blue-50 to-purple-50 min-h-screen">

    <!-- Barra de navegación -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">Panel de Coordinador</div>
                <div class="flex space-x-4">
                    <a href="logout.php" class="text-gray-700 hover:text-blue-600 font-semibold">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Bienvenido, Coordinador</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tarjeta: Crear Programas -->
            <a href="programs.php"
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
                        <h2 class="text-xl font-semibold text-gray-800">Crear Programas</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Ambientes -->
            <a href="environments.php"
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
                        <h2 class="text-xl font-semibold text-gray-800">Crear Ambientes</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Fichas -->
            <a href="groups.php"
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
                        <h2 class="text-xl font-semibold text-gray-800">Crear Fichas</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Instructores -->
            <a href="instructors.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Instructores</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Aprendices -->
            <a href="apprentices.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-red-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Aprendices</h2>
                    </div>
                </div>
            </a>

            <!-- Tarjeta: Crear Clase -->
            <a href="create_class.php"
                class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-transform duration-300 hover:-translate-y-2">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">Crear Clase</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>

</html>