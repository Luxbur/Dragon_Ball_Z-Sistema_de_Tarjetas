<?php
require_once __DIR__ . '/../conexion.php';
class Tarjeta {
    private $db;
    public function __construct() {
        $this->db = Conexion::conectar();
    }
    public function obtenerTarjetasUsuario($usuario_id) {
        $sql = "SELECT t.*, ut.fecha_obtencion
                FROM tarjetas t
                INNER JOIN usuario_tarjetas ut ON t.id = ut.tarjeta_id
                WHERE ut.usuario_id = ?
                ORDER BY ut.fecha_obtencion DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $tarjetas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $tarjetas[] = $fila;
        }
        return $tarjetas;
    }
}
?>