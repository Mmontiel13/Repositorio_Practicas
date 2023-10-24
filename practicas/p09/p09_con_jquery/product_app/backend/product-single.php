<?php
    include_once __DIR__.'/database.php';

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = mysqli_query($conexion, $sql);

        if(!$result){
            die('Consulta fallida');
        }

        $baseJSONR = array();
        while($row = mysqli_fetch_array($result)){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $baseJSONR = array(
                "nombre" => $row['nombre'],
                "descripcion" => array(
                    "precio" => $row['precio'],
                    "unidades" => $row['unidades'],
                    "modelo" => $row['modelo'],
                    "marca" => $row['marca'],
                    "detalles" => $row['detalles'],
                    "imagen" => $row['imagen']
                ),
                "id" => $row['id']
            );

        }
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    $jsonstring = json_encode($baseJSONR);
    echo $jsonstring;
?>