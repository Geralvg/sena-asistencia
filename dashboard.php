

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$role = $_SESSION['user_role'];
switch ($role) {
    case 'super_admin':
        header("Location: dashboard_super_admin.php");
        break;
    case 'coordinator':
        header("Location: dashboard_coordinador.php");
        break;
    case 'instructor':
        header("Location: dashboard_instructor.php");
        break;
    default:
        echo "Rol no reconocido.";
        break;
}
?>