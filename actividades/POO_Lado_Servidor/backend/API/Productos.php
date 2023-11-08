<?php
namespace POOAC\API;
use POOAC\API\DataBase;
require_once __DIR__.'/DataBase.php';
    //Debe extender de Database
    class Productos extends Database {
        private $response = array();

        //Constructor
        public function __construct($nombreBaseDatos = 'marketzone') {
            parent::__construct($nombreBaseDatos);
        }

        //Add
        public function add($producto) {

            $sql = "SELECT * FROM productos WHERE nombre = '{$producto->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
        
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$producto->nombre}', '{$producto->marca}', '{$producto->modelo}', {$producto->precio}, '{$producto->detalles}', {$producto->unidades}, '{$producto->imagen}', 0)";
                if ($this->conexion->query($sql)) {
                    $this->response = array(
                        'status' => 'success',
                        'message' => 'Producto agregado'
                    );
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
            
            $result->free();
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($this->response, JSON_PRETTY_PRINT);
        }
        
        //Delete
        public function delete($id){
            if( isset($_POST['id']) ) {
                $id = $_POST['id'];
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
                if ( $this->conexion->query($sql) ) {
                    $this->response = array(
                        'status' => 'success',
                        'message' => 'Producto eliminado'
                    );
                } else {
                    $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            } 
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($this->response, JSON_PRETTY_PRINT);
        }

        //Edit
        public function edit($producto){
            if(!empty($producto)) {
                // SE TRANSFORMA EL STRING DEL JASON A OBJETO
                $jsonOBJ = json_decode($producto);
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = {$jsonOBJ->id}";
                    if($this->conexion->query($sql)){
                        $this->response = array(
                            'status' => 'success',
                            'message' => 'Producto actualizado'
                        );
                    } else {
                        $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }
        
                $result->free();
                // Cierra la conexion
                $this->conexion->close();
                // SE HACE LA CONVERSIÓN DE ARRAY A JSON
                echo json_encode($this->response, JSON_PRETTY_PRINT);
            }
        }

        //list()
        public function list(){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $data = array();

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($data, JSON_PRETTY_PRINT);
        }

        //Search
        public function search($search){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $data = array();
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($_GET['search']) ) {
                $search = $_GET['search'];
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $data[$num][$key] = utf8_encode($value);
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($data, JSON_PRETTY_PRINT);
        }

        //single
        public function single($id){
            if( isset($_POST['id']) ) {
                $id = $_POST['id'];
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE id = {$id}";
                $result = mysqli_query($this->conexion, $sql);
        
                if(!$result){
                    die('Consulta fallida');
                }
        
                $baseJSONR = array();
                while($row = mysqli_fetch_array($result)){
                    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
                    $baseJSONR = array(
                        "nombre" => $row['nombre'],
                        "precio" => $row['precio'],
                        "unidades" => $row['unidades'],
                        "modelo" => $row['modelo'],
                        "marca" => $row['marca'],
                        "detalles" => $row['detalles'],
                        "imagen" => $row['imagen'],
                        "id" => $row['id']
                    );
        
                }
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $jsonstring = json_encode($baseJSONR);
            echo $jsonstring;
        }

        //SingleByName
        public function singleByName($search){
            $data = array();
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($_GET['search']) ) {
                $search = $_GET['search'];
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE (nombre LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $data[$num][$key] = utf8_encode($value);
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($data, JSON_PRETTY_PRINT);
        }

        //GetResponse
        public function getResponse() {
            return json_encode($this->response);
        }
        
    }
?>
