<?php
require_once dirname(__FILE__) . '/../database/DB.php';

// Verificar si la solicitud es mediante POST y si se proporcionó una consulta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    // Obtener la consulta del usuario
    $query = $_POST['query'];

    
    $db = new DB();
    $conn = $db->connect();

    // Limpiar y escapar la consulta para prevenir inyección SQL
    $query = $conn->real_escape_string($query);
    //$sql = "SELECT id_orden, orden_trabajo.numero_orden as 'Numero_de_orden', orden_trabajo.fecha as 'Fecha', orden_trabajo.descripcion as 'Descripcion', usuarios.nombre_usuario as 'Responsable', establecimientos.nombre as 'Establecimiento' FROM orden_trabajo INNER JOIN usuarios ON orden_trabajo.responsable = usuarios.id_usuario INNER JOIN establecimientos ON orden_trabajo.establecimiento = establecimientos.id_establecimiento WHERE orden_trabajo.numero_orden LIKE '$query%'";
    $sql = "SELECT ot_id, daem_ordenesTrabajo.ot_fecha as 'Fecha', daem_ordenesTrabajo.ot_descripcion as 'Descripcion', daem_usuarios.usr_username as 'Responsable', daem_establecimientos.est_nombre as 'Establecimiento' FROM daem_ordenesTrabajo INNER JOIN daem_usuarios ON daem_ordenesTrabajo.ot_responsable = daem_usuarios.usr_id INNER JOIN daem_establecimientos ON daem_ordenesTrabajo.ot_establecimiento = daem_establecimientos.est_id WHERE ot_id LIKE '$query%'";
    $result = $conn->query($sql);

   
    if ($result) {
        $resultados = [];
        // Recorrer los resultados y guardarlos en un array
        while ($fila = $result->fetch_assoc()) {
            $resultados[] = [
                'ot_id' => $fila['ot_id'],
                'Fecha' => $fila['Fecha'],
                'Descripcion' => $fila['Descripcion'],
                'Responsable' => $fila['Responsable'],
                'Establecimiento' => $fila['Establecimiento']
            ];
        }
        $conn->close();
        // Devolver los resultados en formato JSON
        echo json_encode($resultados);
    } else {
        echo json_encode(array('error' => 'Error en la consulta SQL: ' . $conn->error));
    }
} else {
    echo json_encode(array('error' => 'Solicitud no válida'));
}
?>
