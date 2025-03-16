<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Método para autenticar al usuario
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user; // Retorna los datos del usuario si la contraseña es correcta
            }
        }
        return false; // Retorna false si las credenciales son incorrectas
    }

    // Método para obtener un usuario por su ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Método para obtener todos los usuarios por rol
    public function getByRole($role) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role = ?");
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para registrar un nuevo usuario
    public function register($username, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
        return $stmt->execute();
    }

    // Método para obtener el último ID insertado
    public function getLastInsertId() {
        return $this->db->insert_id;
    }
}
?>