<?php
class DB {
    private $servidor = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $basedeDatos = "practica";

    public function connect() {
        $conn = new mysqli($this->servidor, $this->usuario, $this->pass, $this->basedeDatos);

        if ($conn->connect_error) {
            die("Error de conexión a la base de datos: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>
