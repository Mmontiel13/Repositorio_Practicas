<?php
namespace POOAC\API;
    //Creacion de la clase abstracta
    abstract class Database {
        protected $conexion;

        //Constructor con paramatro que recibe para la base de datos
        public function __construct(string $nombreBaseDatos) {
            // Inicializa la conexión a la base de datos utilizando el nombre proporcionado
            $this->conexion = @mysqli_connect(
                'localhost',
                'root',
                '130803',
                $nombreBaseDatos
            );

            if (!$this->conexion) {
                die('¡Base de datos NO conectada!');
            }
        }
    }
?>