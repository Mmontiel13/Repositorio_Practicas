<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    
    if (!empty($producto)) {
        $jsonOBJ = json_decode($producto);
        @$link = new mysqli('localhost', 'root', '130803', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
            /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        $nombre = $jsonOBJ->nombre;
        $checkQuery = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $checkResult = $link->query($checkQuery);

        if ( $checkResult && $checkResult->num_rows > 0 ) 
        {
            echo json_encode(['message' => 'El producto ya existe en la base de datos.', 'success' => false]);
        }
        else
        {
            $marca = $jsonOBJ->marca;
            $modelo = $jsonOBJ->modelo;
            $precio = $jsonOBJ->precio;
            $detalles = $jsonOBJ->detalles;
            $unidades = $jsonOBJ->unidades;
            $imagen = $jsonOBJ->imagen;
            $eliminado = 0;
            $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', '{$eliminado}')";
            if ($link->query($sql)){
                echo json_encode(['message' => 'El Producto se insertó', 'success' => true]);
            }else{
                echo json_encode(['message' => 'El Producto no pudo ser insertado =(', 'success' => false]);
            }            
        }
        
        $link->close();
    }
?>
  
