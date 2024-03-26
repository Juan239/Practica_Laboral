<?php
require_once dirname(__FILE__) . '/../database/DB.php';

class tipoInforme{

    public function __construct()
    {
        
    }

    public function listarTipoInformes(){
        $db = new DB();
        $conn = $db->connect();

        $sql = "SELECT * FROM daem_tipoInformes";

        $result = $conn->query($sql);

        return $result;
    }
}