<?php
namespace BACKEND\API\Update;
use BACKEND\API\DataBase;
require_once __DIR__ . '/../DataBase.php';
    
    class Actualizar extends DataBase{
        public function edit($jsonOBJ) {
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $this->response = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($jsonOBJ->ID_Cuenta) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql =  "UPDATE contenido SET tipo='{$jsonOBJ->tipo}', region='{$jsonOBJ->region}',";
                $sql .= "genero='{$jsonOBJ->genero}', titulo={$jsonOBJ->titulo}, duracion='{$jsonOBJ->duracion}',"; 
                $sql .= "ID_Cuenta={$jsonOBJ->ID_Cuenta} WHERE ID_Contenido={$jsonOBJ->ID_Contenido}";
                $this->conexion->set_charset("utf8");
                if ( $this->conexion->query($sql) ) {
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "Contenido actualizado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            }
        }
    }
?>