<?php
session_start();
require_once "../model/usuarioModel.php";
include_once "../database/DB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Conectar a la base de datos
    $conexionDB = new DB();
    $conexion = $conexionDB->connect();

    $usuarioModel = new UsuarioModel($conexion);

    $usuario = $usuarioModel->verificarCredenciales($nombre_usuario, $contrasena);

    if ($usuario) {
        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre_usuario"] = $nombre_usuario;
        header("Location: ../view/busqueda.php");
        exit();
    } else {
        $_SESSION["error_login"] = "Usuario o contraseña incorrectos";
        header("Location:../view/index.php");
    }

    $conexion->close();
}
?>



