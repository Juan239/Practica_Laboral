<?php
require_once '../database/DB.php';

class ordenTrabajo{
    public $numeroOrden;
    public $fecha;
    public $descripcion;
    public $observaciones;
    public $responsable;
    public $establecimiento;
    public $intervencion;

    public function __construct($numeroOrden, $fecha, $descripcion, $observaciones, $responsable, $establecimiento, $intervencion)
    {
        $this->numeroOrden = $numeroOrden;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->observaciones = $observaciones;
        $this->responsable = $responsable;
        $this->establecimiento = $establecimiento;
        $this->intervencion = $intervencion;
    }


    public function registrarOrden(){
        $db = new DB();
        $conn = $db->connect();

        $sql = "INSERT INTO orden_trabajo(numero_orden, fecha, descripcion, observaciones, responsable, establecimiento, intervencion)VALUES(?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $this->numeroOrden, $this->fecha, $this->descripcion, $this->observaciones, $this->responsable, $this->establecimiento, $this->intervencion);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

        $stmt->close();
        $conn->close();
    }

    public function mostrarEscuelas(){
        $db = new DB();
        $conn = $db->connect();

        $sql = "SELECT * FROM establecimientos";

        $result = $conn->query($sql);

        return $result;
    }

    public function mostrarTabla() {
        $db = new DB();
        $conn = $db->connect();
    
        $sql = 'SELECT id_orden, orden_trabajo.numero_orden as "Numero_de_orden", orden_trabajo.fecha as "Fecha", orden_trabajo.descripcion as "Descripcion", orden_trabajo.observaciones as "Observaciones", usuarios.nombre_usuario as "Responsable", establecimientos.nombre as "Establecimiento", intervenciones.nombre as "Intervencion" FROM (((orden_trabajo INNER JOIN usuarios ON orden_trabajo.responsable = usuarios.id_usuario) INNER JOIN establecimientos ON orden_trabajo.establecimiento = establecimientos.id_establecimiento) INNER JOIN intervenciones ON orden_trabajo.intervencion = intervenciones.id_intervencion) ORDER BY id_orden DESC';
        $result = $conn->query($sql);
    
        $ordenes = [];
        while ($row = $result->fetch_assoc()) {
            $ordenes[] = $row;
        }
        /*
        echo '<div class="table-responsive">';
        echo '<table class="table table-hover">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th scope="col" style="width: 10%;">Número de Orden</th>';
        echo '<th scope="col" style="width: 10%;">Fecha</th>'; 
        echo '<th scope="col" style="width: 25%;">Descripción</th>'; 
        echo '<th scope="col" style="width: 20%;">Observaciones</th>'; 
        echo '<th scope="col" style="width: 10%;">Responsable</th>'; 
        echo '<th scope="col" style="width: 15%;">Establecimiento</th>'; 
        echo '<th scope="col" style="width: 10%;">Intervención</th>'; 
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Numero_de_orden'] . '</td>';
            echo '<td>' . $row['Fecha'] . '</td>';
            echo '<td>' . $row['Descripcion'] . '</td>';
            echo '<td>' . $row['Observaciones'] . '</td>';
            echo '<td>' . $row['Responsable'] . '</td>';
            echo '<td>' . $row['Establecimiento'] . '</td>';
            echo '<td>' . $row['Intervencion'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; */
    
        $conn->close();

        return $ordenes;
    }
    public function busquedaOrdenes($query){
        $db = new DB();
        $conn = $db->connect();
    
        $query = $conn->real_escape_string($query);
    
        $sql = "SELECT id_orden, orden_trabajo.numero_orden as 'Numero_de_orden', orden_trabajo.fecha as 'Fecha', orden_trabajo.descripcion as 'Descripcion', usuarios.nombre_usuario as 'Responsable', establecimientos.nombre as 'Establecimiento' FROM orden_trabajo INNER JOIN usuarios ON orden_trabajo.responsable = usuarios.id_usuario INNER JOIN establecimientos ON orden_trabajo.establecimiento = establecimientos.id_establecimiento WHERE Numero_de_orden LIKE '%$query%'";
    
        $result = $conn->query($sql);
    
        if ($result) {
            $resultados = [];
            // Recorrer los resultados y guardarlos en un array
            while ($fila = $result->fetch_assoc()) {
                $resultado = array(
                    'id_orden' => $fila['id_orden'],
                    'Numero_de_orden' => $fila['Numero_de_orden'],
                    'Fecha' => $fila['Fecha'],
                    'Descripcion' => $fila['Descripcion'],
                    'Responsable' => $fila['Responsable'],
                    'Establecimiento' => $fila['Establecimiento']
                );
                // Agrega el resultado al array de resultados
                $resultados[] = $resultado;
            }            
            $conn->close();
            return $resultados;
        } else {
            $conn->close();
            return [];
        }
    }
    
    
    
    
}