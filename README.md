# SENA Asistencias

Este es un sistema de gestión de asistencias para el SENA.

## Requisitos
- PHP 7.4+
- MySQL 5.7+
- Servidor web (Apache, Nginx, etc.)

## Instalación
1. Clona el repositorio.
2. Importa la base de datos desde `sena_asistencias.sql`.
3. Configura las credenciales de la base de datos en `includes/Database.php`.
4. Ejecuta el servidor: `php -S localhost:8000`.
5. Accede a `http://localhost:8000` en tu navegador.

## Uso
- **Super Administrador**: Puede registrar coordinadores.
- **Coordinador**: Puede crear programas, ambientes, fichas e instructores.
- **Instructor**: Puede tomar lista de asistencia.