<?php
session_start();
require_once __DIR__ . '/../model/tarjeta.php';
class TarjetasController {
    private $tarjetaModel;
    public function __construct() {
        $this->tarjetaModel = new Tarjeta();
    }
    public function misTarjetas() {
        if (!isset($_SESSION['usuario_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autorizado']);
            exit;
        }
        $usuario_id = $_SESSION['usuario_id'];
        $tarjetas = $this->tarjetaModel->obtenerTarjetasUsuario($usuario_id);
        echo json_encode($tarjetas);
    }
}
?>