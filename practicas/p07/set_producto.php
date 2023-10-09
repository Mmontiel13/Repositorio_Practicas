<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST['nombre_producto'];
        $marca  = $_POST['marca_producto'];
        $modelo = $_POST['modelo_producto'];
        $precio = $_POST['precio_producto'];
        $detalles = $_POST['detalles_producto'];
        $unidades = $_POST['unidades_producto'];
        $imagen   = $_POST['imagen_producto'];
        $eliminado = 0;


        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', '130803', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
            /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        /** Crear una tabla que no devuelve un conjunto de resultados */
        $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', '{$eliminado}')";
        if ( $link->query($sql) ) 
        {
            echo 'Producto insertado con ID: '.$link->insert_id.'<br>';
            echo 'Nombre: '.$nombre.'<br>';
            echo 'Marca: '.$marca.'<br>';
            echo 'Modelo: '.$modelo.'<br>';
            echo 'Precio: '.$precio.'<br>';
            echo 'Detalles: '.$detalles.'<br>';
            echo 'Unidades: '.$unidades.'<br>';
            echo 'Imagen: '.$imagen.'<br>';
        }
        else
        {
            echo 'El Producto no pudo ser insertado =(';
        }

        $link->close();
    }
?>