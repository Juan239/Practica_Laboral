<?php
session_start();

require_once '../model/ordenTrabajoModel.php';

if (isset($_SESSION["nombre_usuario"])) {
    $nombreUsuario = $_SESSION["id_usuario"];
} else {
    header("Location: ../view/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroOrden = $_POST["numeroOrden"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];
    $observaciones = $_POST["observaciones"];
    $responsable = $nombreUsuario;
    $establecimiento = "1";
    $intervencion = $_POST["intervencion"];

    $ordenTrabajo = new ordenTrabajo($numeroOrden, $fecha, $descripcion, $observaciones, $responsable, $establecimiento, $intervencion);

    if ($ordenTrabajo->registrarOrden()) {
        header("Location: ../view/informes.php");
    } else {
        echo "Error al guardar la orden";
    }
}
?>
