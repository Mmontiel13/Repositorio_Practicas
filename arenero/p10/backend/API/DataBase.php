<?php
namespace PRACTICA10\DATABASE;

abstract class DataBase{
    protected $conexion;

    public function __construct($nombreBD) {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            'Normita1230',
            $nombreBD
        );

        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
    }
}
?>