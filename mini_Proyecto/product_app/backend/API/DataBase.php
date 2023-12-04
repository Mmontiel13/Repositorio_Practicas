<?php
namespace BACKEND\API;

abstract class DataBase {
    //Atributos protegidos
    protected $conexion;
    protected $response;

    //Metodos clase DataBase
    public function __construct($database) {
        $this->response = array();
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            '130803',
            $database
        );
        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
    }
    
    public function getResponse() {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>