<?php
require_once __DIR__ . '/../conexion.php';
class Usuario {
    private $db;
    public function __construct() {
        $this->db = Conexion::conectar();
    }
    public function login($username, $password) {
        // La contraseña se almacena con MD5
        $password_md5 = md5($password);
        $sql = "SELECT id, username, nombre_completo FROM usuarios WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $username, $password_md5);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows === 1) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>