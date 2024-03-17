<?php
function verificarSesion() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id_usuario'])) {
        // Si no hay una sesión activa, redirige al usuario al formulario de inicio de sesión
        header("Location: ../view/index.php");
        exit(); // Asegúrate de detener la ejecución del script después de redirigir
    }
}