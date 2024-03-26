<?php
if(isset($_POST['option'])) {
    $opcion = $_POST['option'];
    switch($opcion) {
        case "1":
            require 'formularios/formOrdenTrabajo.php';
            break;
        case "2":
           // include 'opcion2.php';
            echo "orden compra";
            break;
        case "3":
           // include 'opcion3.php';4
            echo "recomendaciones";
            break;
        default:
            echo "Opción no válida";
            break;
    }
}
?>