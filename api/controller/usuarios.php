<?php
session_start();
require_once __DIR__ . '/../model/usuario.php';
class UsuariosController {
    private $usuarioModel;
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }
    public function login() {
        // Recibir datos POST
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos']);
            exit;
        }
        $usuario = $this->usuarioModel->login($username, $password);
        if ($usuario) {
            // Crear sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            // Respuesta exitosa
            echo json_encode(['success' => true, 'usuario' => $usuario]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Usuario o contraseña incorrectos']);
        }
    }
    public function logout() {
        session_destroy();
        echo json_encode(['success' => true]);
    }
}
?>