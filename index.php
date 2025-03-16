<?php
session_start();
require 'includes/Database.php';
require 'includes/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['username'] = $loggedInUser['username'];
        $_SESSION['user_role'] = $loggedInUser['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Credenciales incorrectas. Inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SENA Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-md transform transition-transform duration-300 hover:scale-105">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Bienvenido</h2>
            <p class="mt-2 text-sm text-gray-600">Inicia sesión para acceder a tu cuenta</p>
        </div>
        <?php if (isset($error_message)): ?>
            <div class="text-red-500 text-sm text-center mt-4">
                <?= $error_message ?>
            </div>
        <?php endif; ?>
        <form method="POST" class="mt-8 space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    required
                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                    placeholder="Ingresa tu usuario"
                >
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                    placeholder="Ingresa tu contraseña"
                >
            </div>
            <div>
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition duration-300 shadow-lg"
                >
                    Ingresar
                </button>
            </div>
        </form>
    </div>
</body>
</html>