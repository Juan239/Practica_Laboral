<?php
require_once '../database/DB.php';

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarCredenciales($nombre_usuario, $contrasena) {
        $sql = "SELECT id_usuario, nombre_usuario, contrasenia FROM usuarios WHERE nombre_usuario = ? AND contrasenia = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ss", $nombre_usuario, $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }
}