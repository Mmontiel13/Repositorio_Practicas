<?php
namespace PRACTICA10\PRODUCTOS;

require_once __DIR__.'/DataBase.php';
use PRACTICA10\DATABASE\DataBase as DataBase;


class Productos extends DataBase{
    private $response;

    public function __construct($nombreBD='marketzone'){
        parent::__construct($nombreBD);
        $this->response = array();
    }

    public function obtenerConexion() {
        if($this->conexion){
            return 1;
        }else{
            return 0;
        }
    }

    public function add($Producto){
        $this->response = [
            'status' => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        ];
        $sql = "SELECT * FROM productos_2 WHERE nombre = '{$Producto->nombre}' AND eliminado = 0";
	    $result = $this->conexion->query($sql);
        if ($result->num_rows == 0) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos_2 VALUES (null, '{$Producto->nombre}', '{$Producto->marca}', '{$Producto->modelo}', {$Producto->precio}, '{$Producto->detalles}', {$Producto->unidades}, '{$Producto->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto agregado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó";
            }
        }

        $result->free();
        // Cierra la conexion
        $this->conexion->close();
    }

    public function delete($Id){
        $this->response = [
            'status' => 'error',
            'message' => 'ERROR: No se ejecuto'
        ];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE productos_2 SET eliminado=1 WHERE id = {$Id}";
        if ( $this->conexion->query($sql) ) {
            $this->response['status'] =  "success";
            $this->response['message'] =  "Producto eliminado";
        }
        $this->conexion->close();
    }

    public function edit($Producto){
        $this->response = [
            'status' => 'error',
            'message' => 'La consulta falló'
        ];
        
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql =  "UPDATE productos_2 SET nombre='{$Producto->nombre}', marca='{$Producto->marca}',";
        $sql .= "modelo='{$Producto->modelo}', precio={$Producto->precio}, detalles='{$Producto->detalles}',"; 
        $sql .= "unidades={$Producto->unidades}, imagen='{$Producto->imagen}' WHERE id={$Producto->id}";
        $this->conexion->set_charset("utf8");
        if ( $this->conexion->query($sql) ) {
            $this->response['status'] =  "success";
            $this->response['message'] =  "Producto actualizado";
        }
        $this->conexion->close();
    }

    public function list(){
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $sql = "SELECT * FROM productos_2 WHERE eliminado = 0";
        $result = $this->conexion->query($sql);
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ($result) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error');
        }
        $this->conexion->close();
    }

    public function search($Coincidencia){
        $sql = "SELECT * FROM productos_2 WHERE (id = '{$Coincidencia}' OR nombre LIKE '%{$Coincidencia}%' OR marca LIKE '%{$Coincidencia}%' OR detalles LIKE '%{$Coincidencia}%') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: ');
        }
        $this->conexion->close();
    }

    public function single($Id){
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $this->conexion->query("SELECT * FROM productos_2 WHERE id = {$Id}") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $this->response[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: ');
        }
        $this->conexion->close();
    }

    public function singleByName($Nombre){
        $this->response = [
            'status'  => 'success',
            'message' => 'Búsqueda exitosa, no se encontraron productos similares.'
        ];
        // SE REALIZA LA QUERY DE BÚSQUEDA
        $sql = "SELECT * FROM productos_2 WHERE nombre = '$Nombre'";
        $this->conexion->set_charset("utf8");
        if ($result = $this->conexion->query($sql)) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows) && count($rows) > 0) {
                // Se encontraron productos similares
                $this->response['message'] = 'Se encontraron productos similares.';
            }
            $result->free();
        }
        $this->conexion->close();
    }

    public function getResponse(){
        echo json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>